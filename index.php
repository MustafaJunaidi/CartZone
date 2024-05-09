<?php
   require "./PHP/connection.php";
   require "./PHP/functions.php";
   require "./PHP/header.php";
   require "./PHP/headInfo.php";
   require "./PHP/scripts.php";
   require "./PHP/generateItemsFunctions.php";
   require "./PHP/TopPredictedItemsForUser.php";
   require "./PHP/footer.php";
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <?php headInfo() ?>
   </head>
   <body>
      <?php  if(isset($_SESSION['user_name'])) showHeader($_SESSION['user_name']); else echo showHeader("Guest");  ?>
      <div class="container-flued mx-5 mt-5">
         <div class="d-flex flex-row justify-content-around align-items-center  mt-4 p-5 text-white rounded " style="background-color: #80D0C7;background-image: linear-gradient(160deg, #80D0C7 11%, #0093E9 79%);" >
            <h1 class="display-5">
               Best products & <br />
               brands in our store
            </h1>
            <p class="h3 text-white" style="text-shadow: 3px 3px 14px #210091">
            <span>&#10003;</span> Trendy Products<br /> <span>&#10003;</span> Factory Prices<br /> <span>&#10003;</span> Excellent Service
            </p> 
         </div>
      </div>
      <?php
         if(isset($_SESSION['user_name']) && !isNew()){
           echo "<div class='suggestText'>Recommended Items For You ";
           if(isset($_SESSION['user_name']))
             echo $_SESSION['user_name']; 
           else echo ""; 
         
           echo "</div>";
             $id = $_SESSION['user_id'];
             displayTopPredictedItemsForUser($id, 4);
           
           echo "<hr>";
         } 
         ?>
      <div class='suggestText' style="text-shadow: 2px 2px 1.2px #210070; background-color: #0093E9;background-image: linear-gradient(160deg, #0093E9 0%, #80D0C7 100%);">
      Hot Items</div>
      <?php generateItems(6) ?>
      <section class="container-flued mx-5 mt-5  rounded" style="background: linear-gradient(270deg,#6B73FF,#210070);">
            <header class="pt-4 pb-3 mx-full text-center">
               <h3 class="title ">Why choose us</h3>
            </header>
            <div class="container d-flex justify-content-around text-dark py-3 px-5">
            
            <div class="row mb-4">
               <div class="col-lg-4 col-md-6">
                  <figure class="d-flex align-items-center mb-4">
                     <span class="rounded-circle bg-white p-3 d-flex me-2 mb-2">
                     <i class="fas fa-money fa-2x fa-fw text-primary floating featured-icon" ></i>
                     </span>
                     <figcaption class="info">
                        <h6 class="title">Reasonable prices</h6>
                     </figcaption>
                  </figure>
               </div>
               <div class="col-lg-4 col-md-6 " >
                  <figure class="d-flex align-items-center mb-4">
                     <span class="rounded-circle bg-white p-3 d-flex me-2 mb-2">
                     <i class="fas fa-star fa-2x fa-fw text-primary floating featured-icon" ></i>
                     </span>
                     <figcaption class="info">
                        <h6 class="title">Best quality</h6>
                     </figcaption>
                  </figure>
               </div>
               <div class="col-lg-4 col-md-6">
                  <figure class="d-flex align-items-center mb-4">
                     <span class="rounded-circle bg-white p-3 d-flex me-2 mb-2">
                     <i class="fas fa-plane fa-2x fa-fw text-primary floating featured-icon"></i>
                     </span>
                     <figcaption class="info">
                        <h6 class="title">Worldwide shipping</h6>
                     </figcaption>
                  </figure>
               </div>
               <div class="col-lg-4 col-md-6">
                  <figure class="d-flex align-items-center mb-4">
                     <span class="rounded-circle bg-white p-3 d-flex me-2 mb-2">
                     <i class="fas fa-users fa-2x fa-fw text-primary floating featured-icon" ></i>
                     </span>
                     <figcaption class="info">
                        <h6 class="title">Customer satisfaction</h6>
                     </figcaption>
                  </figure>
               </div>
               <div class="col-lg-4 col-md-6">
                  <figure class="d-flex align-items-center mb-4">
                     <span class="rounded-circle bg-white p-3 d-flex me-2 mb-2">
                     <i class="fas fa-thumbs-up fa-2x fa-fw text-primary floating featured-icon"></i>
                     </span>
                     <figcaption class="info">
                        <h6 class="title">Happy customers</h6>
                     </figcaption>
                  </figure>
               </div>
               <div class="col-lg-4 col-md-6">
                  <figure class="d-flex align-items-center mb-4">
                     <span class="rounded-circle bg-white p-3 d-flex me-2 mb-2">
                     <i class="fas fa-box fa-2x fa-fw text-primary floating featured-icon"></i>
                     </span>
                     <figcaption class="info">
                        <h6 class="title">Thousand items</h6>
                     </figcaption>
                  </figure>
               </div>
            </div>
         </div>
      </section>
      <div class="container mt-5">
         <div class="row mx-auto text-center">
            <div class="col-lg-4 mb-4">
               <div class="card">
                  <div class="card-body">
                     <i class="fas fa-tshirt fa-3x mb-3"></i>
                     <h5 class="card-title">Clothing</h5>
                     <p class="card-text">Explore our huge and latest clothing collection.</p>
                     <a href="filter.php?category=clothing&page=1" class="button ">Click Here</a>
                  </div>
               </div>
            </div>
            <div class="col-lg-4 mb-4">
               <div class="card">
                  <div class="card-body">
                     <i class="fas fa-mobile-alt fa-3x mb-3"></i>
                     <h5 class="card-title">Electronics</h5>
                     <p class="card-text">Discover cutting-edge electronic gadgets and devices.</p>
                     <a href="filter.php?category=electronic&page=1" class="button ">Click Here</a>
                  </div>
               </div>
            </div>
            <div class="col-lg-4 mb-4">
               <div class="card">
                  <div class="card-body">
                     <i class="fas fa-shopping-basket fa-3x mb-3"></i>
                     <h5 class="card-title">Groceries</h5>
                     <p class="card-text">Shop for your daily grocery needs for the cheapest.</p>
                     <a href="filter.php?category=groceries&page=1" class="button">Click Here</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?php showFooter() ?>
      <script src="script/main.js"></script>
      <script src="script/search.js"></script>
      <?php scripts() ?>
   </body>
</html>