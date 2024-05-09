<?php
   require "./PHP/connection.php";
   require "./PHP/functions.php";
   require "./PHP/header.php";
   require "./PHP/headInfo.php";
   require "./PHP/scripts.php";
   require "./PHP/generateItemsFunctions.php";
   require "./PHP/TopPredictedItemsForUser.php";
   require "./PHP/footer.php";
   
   $search = isset($_GET['search']) ? $_GET['search'] : '';
   $rate = isset($_GET['rate']) ? $_GET['rate'] : '';
   $price = isset($_GET['price']) ? $_GET['price'] : '';
   $category = isset($_GET['category']) ? $_GET['category'] : '';
   
   $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
   $itemsPerPage = 10; 
   
   if (isset($_GET['submit'])) {
       $filterUrl = "filter.php?search=$search&rate=$rate&price=$price&category=$category&page=$currentPage";
       header("Location: $filterUrl");
       exit();
   }
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <?php headInfo() ?>
   </head>
   <body>
      <?php
         if (isset($_SESSION['user_name'])) {
           showHeader($_SESSION['user_name']);
         } else {
           echo showHeader("Guest");
         }
         ?>
      <div class="container mt-5 mb-5">
         <div class="row d-flex justify-content-center filter-bar">
            <div class="col-md-3 mb-2">
               <form action="filter.php" method="GET">
                  <label for="search" class="filter-label">Search</label>
                  <input name="search" type="text" class="form-control" placeholder="Search" value="<?php echo $search; ?>">
            </div>
            <div class="col-md-4 mb-2">
            <label for="price" class="filter-label">Price</label>
            <select name="price" class="form-control" >
            <option value="" <?php if ($price == '') echo 'selected'; ?>>All</option>
            <option value="low" <?php if ($price == 'low') echo 'selected'; ?>>Less than 5$</option>
            <option value="medium" <?php if ($price == 'medium') echo 'selected'; ?>>Between 5$ and 20$</option>
            <option value="high" <?php if ($price == 'high') echo 'selected'; ?>>More than 50$</option>
            </select>
            </div>
            <div class="col-md-3 mb-2">
            <label for="category" class="filter-label">Category</label>
            <select name="category" class="form-control">
            <option value="" <?php if ($category == '') echo 'selected'; ?>>All</option>
            <option value="electronic" <?php if ($category == 'electronic') echo 'selected'; ?>>Electronics</option>
            <option value="clothing" <?php if ($category == 'clothing') echo 'selected'; ?>>Clothing</option>
            <option value="Groceries" <?php if ($category == 'groceries') echo 'selected'; ?>>Groceries</option>
            </select>
            </div>
            <button name="submit" type="submit" class="mt-3 filter-button btn-block text-center">Apply</button>
            </form>
         </div>
      </div>
      <?php generateFilteredItems($search, $price, $category, $currentPage, $itemsPerPage) ?>
      <?php showFooter() ?>
      <script src="script/main.js"></script>
      <script src="script/search.js"></script>
      <?php scripts() ?>
   </body>
</html>