<?php
session_start();
require "./PHP/header.php";
require "./PHP/headInfo.php";
require "./PHP/scripts.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php headInfo() ?>
    <title>Online Shopping</title>
  </head>

  <body>
    <?php showAdminHeader($_SESSION['admin_name']); ?>

    <div class="dashboard-container">
      <div class="grid-item">
        <img
          src="images/cart.png"
          class="dashboard-image"
          alt="image not found"
        />
        <h2>Items Sold Today</h2>
        <p>50</p>
      </div>
      <div class="grid-item">
        <img
          src="images/dollar.png"
          class="dashboard-image"
          alt="image not found"
        />
        <h2>Money Made Today</h2>
        <p>$500</p>
      </div>
      <div class="grid-item">
        <img
          src="images/web.png"
          class="dashboard-image"
          alt="image not found"
        />
        <h2>Visits Today</h2>
        <p>100</p>
      </div>
    </div>

    <div class="separator"></div>

    <div class="button-grid mb-3">
      <button id="add-item" onclick="window.location.href='add_items.html'">
        Add new item
      </button>
      <button
        id="edit-remove-item"
        onclick="window.location.href='items_table.php'"
      >
        Edit/Remove item
      </button>
      <button id="show-users" onclick="window.location.href='users_table.php'">
        Show users
      </button>
    </div>

    <script src="script/main.js"></script>
    <?php scripts(); ?>
  </body>
</html>
