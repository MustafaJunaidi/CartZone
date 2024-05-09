<?php
   require "./PHP/connection.php";
   require "./PHP/headInfo.php";
   require "./PHP/scripts.php";
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
     $signup_email = $_POST["signup_email"];
     $signup_name = $_POST["signup_name"];
     $signup_password = $_POST["signup_password"];
   }
   
   if (isset($signup_name, $signup_email, $signup_password)) {
     $sql2 = "SELECT customer_name from customer where customer_name='$signup_name'";
     $result = DB()->query("$sql2");
     if ($result->num_rows > 0) {
       echo '<script>';
       echo 'alert("Customer Already Exists")';
       echo '</script>';
     } else {
       $sql = "INSERT INTO customer (customer_name, customer_email, customer_password)
       VALUES ('$signup_name', '$signup_email', '$signup_password')";
   
       if (DB()->query("$sql") === true) {
         echo '<script>';
         echo 'alert("Account Created Successfully")';
         echo '</script>';
       } else {
         echo '<script>';
         echo 'alert("Customer Already Exists")';
         echo '</script>';
       }
   
     }
   }
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <?php headInfo() ?>
   </head>
   <body class="reg-body">
      <div class="container">
         <div class="row d-flex justify-content-center align-items-center vh-100">
            <div class="col-md-6 text-center mb-3 reg-img">
               <img src="./images/logo4.png" alt="CartZone" class="img-fluid">
            </div>
            <div class="col-md-6">
               <!-- LOGIN -->
               <div class="input-block" id="login_box">
                  <h2 class="text-center">Login</h2>
                  <form method="POST" action="PHP/account_login.php">
                     <div class="form-group">
                        <label for="username">Username:</label>
                        <input name="name" id="email_login" type="text" class="form-control mb-3" placeholder="Enter your username">
                     </div>
                     <div class="form-group">
                        <label for="password">Password:</label>
                        <input name="password" id="password_login" type="password" class="form-control mb-3" placeholder="Enter your password">
                     </div>
                     <button type="submit" id="login_submit" class="btn button btn-block mx-auto d-block">Login</button>
                  </form>
                  <span class="d-block mt-3 text-center">Don't have an account? <a class="link" onclick="toggle_between_login_and_signup()">Register here</a></span>
               </div>
               <!-- Register -->
               <div class="input-block" id="signup_box">
                  <h2 class="text-center">Register</h2>
                  <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                     <div class="form-group">
                        <label for="email">Email:</label>
                        <input name="signup_email" id="email_signup" type="email" class="form-control" id="email" placeholder="Enter your email">
                        <small id="emailHelp" class="form-text text-muted mb-3 d-block"> - We'll never share your email with anyone else.</small>
                     </div>
                     <div class="form-group">
                        <label for="username">Username:</label>
                        <input name="signup_name" id="name_signup" type="text" class="form-control" id="username" placeholder="Enter your username">
                        <small id="userHelp" class="form-text text-muted mb-3 d-block"> - Name must be at least 3 characters long and contains no numbers or
                        spaces</small>
                     </div>
                     <div class="form-group">
                        <label for="password">Password:</label>
                        <input name="signup_password" id="password_signup" type="password" class="form-control " id="password" placeholder="Enter your password">
                        <small id="passwordHelp" class="form-text text-muted mb-3 d-block"> - Password must be at least 8 characters long and contain a
                        combination of letters and numbers</small>
                     </div>
                     <div class="form-group">
                        <label for="repeat-password">Repeat Password:</label>
                        <input  id="password_conf" type="password" class="form-control mb-3" id="repeat-password" placeholder="Repeat password">
                     </div>
                     <button type="submit" id="signup_submit" class="btn button btn-block mx-auto d-block">Register</button>
                  </form>
                  <span class="d-block mt-3 text-center">Already have account? <a class="link" onclick="toggle_between_login_and_signup()">Login Here</a></span>
               </div>
            </div>
         </div>
      </div>
      <script src="script/main.js"></script>
      <?php scripts() ?>
   </body>
</html>