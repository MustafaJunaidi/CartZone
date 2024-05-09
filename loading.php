<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Loading Page</title>
      <style>
         body {
         margin: 0;
         font-family: 'Arial', sans-serif;
         display: flex;
         align-items: center;
         text-align:center;
         justify-content: center;
         height: 100vh;
         background-color: #210070;
         }
         .loader {
         border: 16px solid #2f34ed;
         border-radius: 50%;
         border-top: 16px solid #ffffff;
         width: 120px;
         height: 120px;
         animation: spin 1.5s linear infinite;
         }
         @keyframes spin {
         0% { transform: rotate(0deg); }
         100% { transform: rotate(360deg); }
         }
         .loading-text {
         color:white;
         margin: auto 0;
         margin-top: 20px;
         font-size: 20px;
         }
      </style>
   </head>
   <body>
      <div id="loading" class="text-center">
         <div class="loader"></div>
         <div class="loading-text">Logging in...</div>
      </div>
      <script>
         window.onload = function() {
             window.location.href = 'index.php';
         };
      </script>
   </body>
</html>