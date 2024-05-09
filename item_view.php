<?php 
   require "./PHP/connection.php";
   require "./PHP/commentsSection.php";
   require "./PHP/headInfo.php";
   require "./PHP/header.php";
   require "./PHP/functions.php";
   require "./PHP/scripts.php";
   require "./PHP/generateItemsFunctions.php";
   require "./PHP/footer.php";
   
   $currentID = $_GET['id'];
   $_SESSION['item_id'] = $currentID;
   if(isset($_SESSION['user_id'])){
      $userID = $_SESSION['user_id'];
   }
   $url = "PHP/add_to_cart.php?item_id=$currentID";
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <?php headInfo() ?>
   </head>
   <body>
      <?php  if(isset($_SESSION['user_name'])) showHeader($_SESSION['user_name']); else echo showHeader("Guest");  ?>
      <?php
         $query = "SELECT * FROM item where item_id='$currentID'";
         $result = DB()->query($query);
         $user_name = isset($_SESSION['user_name']);
         $q = "SELECT customer_id FROM customer WHERE customer_name='$user_name'";
         $res = DB()->query($q);
         $r = $res->fetch_assoc();
         $rate = $_SESSION['rateArray'][$currentID];
         
         $url="#";
         $Rate_URL="#";
         $commentURL = "#";
         if(isset($_SESSION['user_id'])){
            $url = "./PHP/add_to_cart.php?customer_id=$userID&item_id=$currentID";
            $Rate_URL = "./PHP/item_rate.php?customer_id=$userID&item_id=$currentID";
            $commentURL = "./PHP/add_comment.php";
         }
         function errorMessage(){
            echo "<script>alert('You must login to do this feature')</script>";
         }
         if ($result && $result->num_rows > 0) {
         
           $row = $result->fetch_assoc();
           $Image=$row['item_img'];
           $Name=$row['item_name'];
           $Price=$row['item_price'];
           $Description=$row['item_description'];
           $Quantity = $row['item_quantity'];
           $Category = $row['item_category'];
         } else {
           echo "No Information";
         }
         $stockMessage;
         if($Quantity > 0){
           $stockMessage = "in Stock";
         } else {
           $stockMessage = "not Available in stock";
         }
         ?>
      <section class="py-5">
         <div class="container">
            <div class="row gx-5">
               <aside class="col-lg-6">
                  <div class="border rounded-4 mb-3 d-flex justify-content-center">
                     <img style="width: 30vw; height: 70vh; margin: auto;" class="rounded-4 fit" src="<?php echo $Image ?>" />
                  </div>
                  <div class='buy-rate'>
                     <?php
                        if(isset($_SESSION['user_name'])){
                           echo 
                           "
                           <a href='$url' class='button shadow-0'> <i class='me-1 fa fa-shopping-basket'></i> Add to cart </a>
                           <div class='stars' id='rating'>
                              <div class='stars' id='rating'>
                                 <label>Rate:</label>
                                 <a style='color:black' onmouseover='highlightStars(1)' onmouseout='resetStars()' href='PHP/item_rate.php?customer_id=$userID&item_id=$currentID&rate=1 '><span id='star1' class='fa fa-star '></span></a>
                                 <a style='color:black' onmouseover='highlightStars(2)' onmouseout='resetStars()' href='PHP/item_rate.php?customer_id=$userID&item_id=$currentID&rate=2 '><span id='star2' class='fa fa-star '></span></a>
                                 <a style='color:black' onmouseover='highlightStars(3)' onmouseout='resetStars()' href='PHP/item_rate.php?customer_id=$userID&item_id=$currentID&rate=3 '><span id='star3' class='fa fa-star '></span></a>
                                 <a style='color:black' onmouseover='highlightStars(4)' onmouseout='resetStars()' href='PHP/item_rate.php?customer_id=$userID&item_id=$currentID&rate=4 '><span id='star4' class='fa fa-star '></span></a>
                                 <a style='color:black' onmouseover='highlightStars(5)' onmouseout='resetStars()' href='PHP/item_rate.php?customer_id=$userID&item_id=$currentID&rate=5 '><span id='star5' class='fa fa-star '></span></a>
                              </div>
                           </div>
                           ";
                        }
                        ?>
               </aside>
               <main class="col-lg-6">
               <div class="ps-lg-3">
               <h4 class="title text-dark mt-3">
               <?php echo $Name ?>
               </h4>
               <div class="d-flex flex-row my-3">
               <div class=" mb-1 me-2">
               <span class="rating-container" onmouseover="showRatingInfo(this)" onmouseout="hideRatingInfo(this)">
               <?php echo generateStarRating($rate); ?>
               <span class="ms-1">
               <?php echo $rate ?>
               </span>
               </span>
               </div>
               <span class="text-muted"><i class="fas fa-shopping-basket fa-sm mx-1"></i><?php echo $Quantity ?></span>
               <span class="text-success ms-2"><?php echo $stockMessage ?></span>
               </div>
               <div class="mb-3">
               <span class="h5">$<?php echo $Price?></span>
               </div>
               <p>
               <?php echo $Description ?>
               </p>
               <div class="row">
               <dt class="col-3">Category:</dt>
               <dd class="col-9"><?php echo $Category ?></dd>
               </div>
               <?php 
                  if(isset($_SESSION['user_name'])){
                     echo 
                     "
                     <hr />
                     <div class='container mt-1'>
                        <div class='card'>
                           <div class='card-header'>
                              Add a Comment
                           </div>
                           <div class='card-body'>
                              <form method='post' action='$commentURL'>
                                 <div class='mb-3'>
                                    <textarea class='form-control' name='comment' id='comment' rows='3' style='resize: none;' required></textarea>
                                 </div>
                                 <button type='submit' class='button'><i class='me-1 fa fa-comment'></i>Comment</button>
                              </form>
                           </div>
                        </div>
                     </div>
                     ";
                  } else {
                     echo 
                     '<div style="font-weight:bold; font-size: 2rem" class="mt-5">Login to comment and rate</div>';
                  }
                  ?>
               </div>
               </main>
               </div>
            </div>
      </section>
      <section class="bg-light border-top py-4">
      <div class="container">
      <div class="row gx-4">
      <div class="col-lg-8 mb-4 ">
      <div class="border rounded-2 px-3 py-2 bg-white" id="commentsView">
      <div>
      <?php getCommentSection($currentID) ?>
      </div>
      </div>
      </div>
      <div class="col-lg-4">
      <div class="px-0 border rounded-2 shadow-0 similar-items">
      <div class="card">
      <div class="card-body" >
      <h5 class="card-title">Similar items</h5>
      <?php generateItemsCategory($Category, $currentID , 8) ?>
      </div>
      </div>
      </div>
      </div>
      </div>
      </div>
      </section>
      </div>
      <?php showFooter()?>
      <script src="script/search.js"></script>
      <script src="script/rate.js"></script>
      <script src="script/main.js"></script>
      <script src="script/ratePercentage.js"></script>
      <?php scripts() ?>
   </body>
</html>