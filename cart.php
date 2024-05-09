<?php
   require "./PHP/connection.php";
   require "./PHP/headInfo.php";
   require "./PHP/header.php";
   require "./PHP/scripts.php";
   require "./PHP/functions.php";
   require "./PHP/footer.php";
   $user_name = $_SESSION['user_name'];
   $q = "SELECT customer_id FROM customer WHERE customer_name='$user_name'";
   $res = DB()->query($q);
   $r = $res->fetch_assoc();
   $userID = $r['customer_id'];
   
   
   
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <style>
         .cart-box {
         height: 20rem !important;
         overflow: auto !important;
         }
      </style>
      <?php headInfo() ?>
   </head>
   <body style="background-color: whitesmoke;">
      <?php showHeader($_SESSION['user_name']) ?>
      <section class="h-100 gradient-custom">
         <div class="container py-5">
         <div class="row d-flex justify-content-center my-4 ">
         <div class="col-md-8 ">
            <div class='card mb-4'>
               <?php
                  $customerID_AND_transactionTotal_SQL = "SELECT transaction_id,customer_id,transaction_total FROM transaction WHERE customer_id='$userID' AND transaction_date = 'NULL' ";
                  $result_for_customerID_AND_transactionTotal_SQL = DB()->query($customerID_AND_transactionTotal_SQL);
                  
                  if ($result_for_customerID_AND_transactionTotal_SQL->num_rows > 0) {
                      
                      $row_for_customerID_AND_transactionTotal_SQL = $result_for_customerID_AND_transactionTotal_SQL->fetch_assoc();
                      $transactionID = $row_for_customerID_AND_transactionTotal_SQL['transaction_id'];
                      
                      $customer_cart_SQL = "SELECT item_id FROM transaction_item WHERE transaction_id = '$transactionID' ";
                      $result_for_customer_cart_SQL = DB()->query($customer_cart_SQL);
                      
                      $ItemsNumber_SQL = "SELECT COUNT(*) as NUM FROM transaction_item WHERE transaction_id = '$transactionID' ";
                      $result_for_ItemsNumber_SQL = DB()->query($ItemsNumber_SQL);
                      $NumRow = $result_for_ItemsNumber_SQL->fetch_assoc();
                      $ItemsNumber = $NumRow['NUM'];
                  
                          echo 
                          "
                              
                              <div class='card-header py-3'>
                              <h5 class='mb-0'>Cart - $ItemsNumber items</h5>
                              </div>
                              <div class='card-body cart-box'>
                          ";
                          foreach ($result_for_customer_cart_SQL as $row) {
                              $itemID = $row['item_id'];
                              $transTotal = $row_for_customerID_AND_transactionTotal_SQL['transaction_total'];
                              $delete_url = "PHP/delete_item_from_cart.php?id=" . urlencode($itemID);
                  
                              $itemName_AND_itemPrice_SQL = "SELECT item_name,item_price FROM item WHERE item_id='$itemID'";
                              $result_for_itemName_AND_itemPrice_SQL = DB()->query($itemName_AND_itemPrice_SQL);
                              $row_for_itemName_AND_itemPrice_SQL = $result_for_itemName_AND_itemPrice_SQL->fetch_assoc();
                              $itemName = $row_for_itemName_AND_itemPrice_SQL['item_name'];
                              $itemPrice = $row_for_itemName_AND_itemPrice_SQL['item_price'];
                              $IMG = getImageByID($itemID);
                              echo 
                              "
                              <div class='row'>
                                  <div class='col-lg-3 col-md-12 mb-4 mb-lg-0'>
                                      <!-- Image -->
                                          <div class='bg-image hover-overlay hover-zoom ripple rounded' data-mdb-ripple-color='light'>
                            <img src='$IMG'
                              class='w-100' alt='$itemName' />
                            <a href='#!'>
                              <div class='mask' style='background-color: rgba(251, 251, 251, 0.2)'></div>
                            </a>
                          </div>
                        </div>
                  
                        <div class='col-lg-5 col-md-6 mb-4 mb-lg-0'>
                          <!-- Data -->
                          <p><strong>$itemName</strong></p>
                          <a href='$delete_url' type='button' class='button btn-sm me-1 mb-2' data-mdb-toggle='tooltip'
                            title='Remove item'>
                            <i class='fas fa-trash'></i>
                          </a>
                          <!-- Data -->
                        </div>
                  
                        <div class='col-lg-4 col-md-6 mb-4 mb-lg-0'>
                  
                  
                          <!-- Price -->
                          <p class='text-start text-md-center'>
                            <strong>$$itemPrice</strong>
                          </p>
                          <!-- Price -->
                        </div>
                      </div>
                      <hr class='my-4' />
                              ";
                          }
                      
                  }
                  ?>
            </div>
         </div>
         <?php 
            if(!isset($transTotal)) 
                echo "<h1 class='text-center'>Cart is empty!</h1>";
            else 
                echo 
                "
                <div class='card mb-4 mb-lg-0'>
                  <div class='card-body'>
                    <p><strong>We accept</strong></p>
                    <div>
                      <i class='fab fa-lg fa-cc-visa text-dark'></i>
                      <i class='fab fa-lg fa-cc-amex text-dark'></i>
                      <i class='fab fa-lg fa-cc-mastercard text-dark'></i>
                      <i class='fab fa-lg fa-cc-paypal text-dark'></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class='col-md-4'>
                <div class='card mb-4'>
                  <div class='card-header py-3'>
                    <h5 class='mb-0'>Summary</h5>
                  </div>
                  <div class='card-body'>
                    <ul class='list-group list-group-flush'>
                      <li class='list-group-item d-flex justify-content-between align-items-center px-0'>
                        Shipping
                        <span>Amman</span>
                      </li>
                      <li
                        class='list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3'>
                        <div>
                          <strong>Total amount</strong>
                        </div>
                        <span><strong>$transTotal</strong></span>
                      </li>
                    </ul>
                    
                    <a href='./PHP/checkout.php' type='button' class='button btn-lg btn-block'>
                      Order
                    </a>
                  </div>
                </div>
              </div>
            </div>
            </div>
            
                "
            
            ?>
      </section>
      <?php showFooter() ?>
      <script src="script/search.js"></script>
      <script src="script/main.js"></script>
      <?php scripts(); ?>
   </body>
</html>