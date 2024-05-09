<?php 
function calculateAverageRatings() {
    $averageRatings = array();

    $query = "SELECT item_id, AVG(item_rate) as AVG FROM item_rate GROUP BY item_id";
    $result = DB()->query($query);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $itemId = $row['item_id'];
            $averageRating = $row['AVG'];

            $averageRatings[$itemId] = number_format($averageRating, 1);
        }
    }
    arsort($averageRatings);

    

    return $averageRatings;
}

$_SESSION['rateArray'] = calculateAverageRatings();
function topItems($n){
    $topRatings;
    $counter=0;
    foreach ($_SESSION['rateArray'] as $id => $rate) {
        $topRatings[] = $id;

        $counter++;

        if ($counter >= $n) {
            break;
        }
    }
    return $topRatings;
}

function generateStarRating($rating) {
    $wholeStars = floor($rating);
    $starsHtml = str_repeat("<span class='fa fa-star checked' '></span>", $wholeStars);

    $decimalPart = $rating - $wholeStars;

    if ($decimalPart >= 0.5) {
        $starsHtml .= "<span class='fa fa-star-half-alt checked'></span>";
    } elseif ($decimalPart > 0) {
        $starsHtml .= "<span class='fa fa-star' style='color: grey;'></span>";
    }

    $emptyStars = 5 - ceil($rating);
    $starsHtml .= str_repeat("<span class='fa fa-star' style='color: grey;'></span>", $emptyStars);

    return $starsHtml;
}


function generateItems($n) {
    $visitedItems = array();
    $topRatings = topItems($n);
    $query = "SELECT item_img, item_name, item_price, item_id FROM item WHERE item_id IN (" . implode(',', array_values($topRatings)) . ") ORDER BY FIELD(item_id, " . implode(',', array_values($topRatings)) . ")";
    $result = DB()->query($query);

    if ($result && $result->num_rows > 0) {
        echo "<div class=' row mx-4 mb-5 d-flex justify-content-center'>";
        while ($row = $result->fetch_assoc()) {
            $randomImage = $row['item_img'];
            $randomName = $row['item_name'];
            $randomPrice = $row['item_price'];
            $randomId = $row['item_id'];
            $rate = $_SESSION['rateArray'][$randomId];
            $phpFileUrl = "item_view.php?id=$randomId";

            //Ammar
            echo "
                <div class='col-lg-2 col-md-4 col-sm-6 d-flex'>
                    <div class='card w-100 h-100 my-2 shadow-2-strong'>
                        <img src='$randomImage' class='card-img-top' style='aspect-ratio: 1 / 1'/>
                        <div class='card-body d-flex flex-column'>
                            <h5 class='card-title' style='min-height: 8rem;'>$randomName</h5>
                            <p class='card-text d-flex justify-content-center' style='min-height: 40px;'>$$randomPrice</p>
                            
                            <!-- Star Rating -->
                            <div class='d-flex justify-content-center'>
                                <span class='rating-value ms-2'>$rate</span>
                            </div>
                            <div class='d-flex justify-content-center mb-3'>";
                              echo generateStarRating($rate);
                            echo "</div>
                            
                            <div class='card-footer d-flex justify-content-center pt-3 px-0 pb-0 mt-auto'>
                                <a href='$phpFileUrl' class='button m-4 p-3 w-100 shadow-0 text-center'>View Item</a>
                            </div>
                        </div>
                    </div>
                </div>
            ";
            
            // Omar
//                 echo "
//                 <div class='card d-flex flex-column justify-content-center h align-items-center  m-3 border-0 rounded-0 shadow' style='width: 16rem;'>
//                         <img src='$randomImage' class='card-img-top rounded-0'>
//                         <div class='card-body mt-3 mb-3'>
//                             <div class='row'>
//                                 <div class='col-10'>
//                                     <h4 class='card-title'>$randomName</h4>
//                                     <!-- Star Rating -->
//                                     <div class='d-flex justify-content-center'>
//                                     <span class='rating-value ms-2'>$rate</span>
//                                     </div>
//                                     <div class='d-flex justify-content-center mb-3'>";
//                                     echo generateStarRating($rate);
//                                     echo "</div>
//                                 </div>
//                                 <div class='col-2'>
//                                     <i class='bi bi-bookmark-plus fs-2'></i>
//                                 </div>
//                             </div>
//                         </div>
//                         <div class='row align-items-center text-center g-0'>
//                             <div class='col-4'>
//                                 <h5>$$randomPrice</h5>
//                             </div>
//                             <div class='col-8'>
//                                 <a href='$phpFileUrl' class='btn btn-dark w-100 p-3 rounded-0 text-warning'>View Item</a>
//                             </div>
//                         </div>
//                 </div>
// ";
            // 
        }

        echo "</div>";
    } else {
        return "Array is null";
    }
}

function generateItemsCategory($category, $current_ID , $n){
    $averageRatings = array();

    $query = "SELECT item_id, item_name, item_img, item_price FROM item WHERE item_category='$category' AND item_id!=$current_ID ORDER BY RAND() LIMIT $n;";
    $result = DB()->query($query);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $ID = $row['item_id'];
            $name = $row['item_name'];
            $img = $row['item_img'];
            $price = $row['item_price'];

            $phpFileUrl = "item_view.php?id=$ID";

            echo 
            "<div class='d-flex mb-3'>
                <a href='$phpFileUrl' class='me-3'>
                  <img src='$img' style='width: 110px; height: 90px;' class='' />
                </a>

                <div class='info'>
                  <a href='$phpFileUrl' class='nav-link mb-1'>
                    $name
                  </a>
                  <strong class='text-dark'>$$price</strong>
                </div>
                
              </div>
            ";
        }
    } else {
        return "No Items Found";
    }
}


function generateFilteredItems($search, $price, $category, $currentPage, $itemsPerPage) {
    $offset = ($currentPage - 1) * $itemsPerPage;

    $sql = "SELECT * FROM item WHERE item_name LIKE '%$search%'";

    if ($category !== '') {
        $sql .= " AND item_category = '$category'";
    }

    if ($price !== '') {
        switch ($price) {
            case 'low':
                $sql .= " AND item_price < 5";
                break;
            case 'medium':
                $sql .= " AND item_price >= 5 AND item_price < 20";
                break;
            case 'high':
                $sql .= " AND item_price >= 20";
                break;
        }
    }

    $sql .= " LIMIT $itemsPerPage OFFSET $offset";
    $totalPages = calculateTotalPages($search, $price, $category, $itemsPerPage);
    $result = DB()->query($sql);

   if ($result && $result->num_rows > 0) {
        echo "<div class='row ms-2 me-2 d-flex justify-content-center'>";
        while ($row = $result->fetch_assoc()) {
            $Image = $row['item_img'];
            $Name = $row['item_name'];
            $Price = $row['item_price'];
            $Id = $row['item_id'];
            $rate = $_SESSION['rateArray'][$Id];
            $phpFileUrl = "item_view.php?id=$Id";

            echo "
                <div class='col-lg-2 col-md-4 col-sm-6 d-flex'>
                    <div class='card w-100 my-2 shadow-2-strong'>
                        <img src='$Image' class='card-img-top' style='aspect-ratio: 1 / 1'/>
                        <div class='card-body d-flex flex-column'>
                            <h5 class='card-title' style='min-height: 8rem;'>$Name</h5>
                            <p class='card-text d-flex justify-content-center' style='min-height: 40px;'>$$Price</p>
                            
                            <!-- Star Rating -->
                            <div class='d-flex justify-content-center'>
                                <span class='rating-value ms-2'>$rate</span>
                            </div>
                            <div class='d-flex justify-content-center mb-3'>";
                              echo generateStarRating($rate);
                            echo "</div>
                            
                            <div class='card-footer d-flex justify-content-center pt-3 px-0 pb-0 mt-auto'>
                                <a href='$phpFileUrl' class='button shadow-0 me-1'>View Item</a>
                            </div>
                        </div>
                    </div>
                </div>
            ";


        }

        echo "</div>";
        echo generatePaginationControls($search, $price, $category, $currentPage, $totalPages);
    } else {
        echo '<h1 class="text-center">No items found.</h1>';
    }
}

function generatePaginationControls($search, $price, $category, $currentPage, $totalPages) {
    echo "<div class='pagination d-flex justify-content-center mt-3'>";
    
    // Previous page link
    if ($currentPage > 1) {
        echo "<a href='filter.php?page=" . ($currentPage - 1) . "&search=$search&price=$price&category=$category' class='page-link'>&#8592; Previous</a>";
    }

    // Page selection dropdown
    echo "<span class='current-page mx-2'>$currentPage</span>";


    // Next page link
    if ($currentPage < $totalPages && $totalPages!=1) {
        echo "<a href='filter.php?page=" . ($currentPage + 1) . "&search=$search&price=$price&category=$category' class='page-link'>Next &#8594;</a>";
    }

    echo "</div>";
}

function calculateTotalPages($search, $price, $category, $itemsPerPage) {
    $sql = "SELECT COUNT(*) as total FROM item WHERE item_name LIKE '%$search%'";

    if ($category !== '') {
        $sql .= " AND item_category = '$category'";
    }

    if ($price !== '') {
        switch ($price) {
            case 'low':
                $sql .= " AND item_price < 5";
                break;
            case 'medium':
                $sql .= " AND item_price >= 5 AND item_price < 20";
                break;
            case 'high':
                $sql .= " AND item_price >= 20";
                break;
        }
    }

    $result = DB()->query($sql);

    if ($result && $row = $result->fetch_assoc()) {
        $totalItems = $row['total'];
        $totalPages = ceil($totalItems / $itemsPerPage);
        return $totalPages;
    } 

    return 0;
}
?>