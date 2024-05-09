<?php 

function showHeader($name){
    echo 
    '<header class="navbar navbar-expand-lg" style="padding-right:6rem; padding-left:2rem">
        <div class="mr-1"> 
            <a class="navbar-brand" href="index.php">
                <img src="images/logoN3.png" alt="Not found logo">
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
            <div class="navbar-nav mx-auto">
                <div class="search navbar-form navbar-left">
                    <div class="dropdown">
                        <input id="search" type="text" class="form-control" placeholder="What are you looking for?" oninput="handleSearchChange()" onblur="handleBlur()" onfocus="handleFocus()">
                        <div class="dropdown-content" id="dropdownResults"></div>
                    </div>
                </div>
            </div>
            <ul class="navbar-nav ml-auto">';
            if($name != 'Guest'){
                echo '<li class="nav-item">
                        <a class="nav-link" href="cart.php"><i class="fa fa-shopping-cart"></i> Cart</a>
                    </li>';
            }
            echo '   
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="productsDropdown" role="button" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false"><i class="fa fa-bars"></i> Products</a>
                        <div class="dropdown-menu" aria-labelledby="productsDropdown">
                        <!-- Dropdown content goes here -->
                        <a class="dropdown-item custom-dropdown-item" href="filter.php?category=clothing&page=1">Clothing</a>
                        <a class="dropdown-item custom-dropdown-item" href="filter.php?category=groceries&page=1">Groceries</a>
                        <a class="dropdown-item custom-dropdown-item" href="filter.php?category=electronic&page=1">Electronics</a>
                        </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">';
                        echo $name;
                echo '
                    </a>
                    <div class="dropdown-menu" aria-labelledby="userDropdown">';
                        if($name == 'Guest') 
                            echo '<a class="dropdown-item custom-dropdown-item" href="./register.php">Sign Up</a>';
                        else{
                            echo '<a class="dropdown-item custom-dropdown-item" href="./PHP/logout.php">Logout</a>';
                        }
                echo '
                    </div>
                </li>
            </ul>
        </div>
    </header>
    <script>
    
    </script>
    ';
}

function showAdminHeader($name){
        echo 
    '<header class="navbar navbar-expand-lg" style="padding-right:6rem; padding-left:2rem">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
            <ul class="navbar-nav ml-auto">';
            echo '   
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">';
                        echo $name;
                echo '
                    </a>
                    <div class="dropdown-menu" aria-labelledby="userDropdown">';
                     echo '<a class="dropdown-item custom-dropdown-item" href="./PHP/logout.php">Logout</a>';
                        
                echo '
                    </div>
                </li>
            </ul>
        </div>
    </header>
    <script>
    
    </script>
    ';
}
?>
