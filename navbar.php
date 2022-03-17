<?php
    require_once('session-manager.php');
?>
<!-- header section starts  -->

<header class="header">

    <a href="index.php" class="logo">
        <img src="images/logo.png" width="80" alt="">
    </a>

    <nav class="navbar">
        <a href="index.php#home">home</a>
        <a href="index.php#about">about</a>
        <a href="index.php#menu">packages</a>
        <a href="index.php#review">reviews</a>
        <a href="index.php#contact">contact</a>
        <a href="faqs.php">FAQs</a>
        <?php
            if(SessionManager::isLoggedIn()){
                echo '<a href="logout.php">Logout</a>'; 

                if($_SESSION["type"] !== "user"){
                    echo '<a href="admin-dashboard.php">Administration</a>'; 
                }
            }
            
        ?>
    </nav>

    <div class="icons">
        <?php
            if(SessionManager::isLoggedIn()){
                echo '<a href="Dashboard.php" class="btn">Dashboard</a>'; 
            }
            else{
                echo '<a href="login.php" class="btn">Login</a>';
                echo '<a href="signup.php" class="btn" style="margin-left: 10px; background: white; color: gold">Signup</a>';
            }
            
        ?>
        <div class="fas fa-bars" id="menu-btn"></div>
    </div>

    <div class="search-form">
        <input type="search" id="search-box" placeholder="search here...">
        <label for="search-box" class="fas fa-search"></label>
    </div>

    <div class="cart-items-container">
        <div class="cart-item">
            <span class="fas fa-times"></span>
            <img src="images/cart-item-1.png" alt="">
            <div class="content">
                <h3>cart item 01</h3>
                <div class="price">$15.99/-</div>
            </div>
        </div>
        <div class="cart-item">
            <span class="fas fa-times"></span>
            <img src="images/cart-item-2.png" alt="">
            <div class="content">
                <h3>cart item 02</h3>
                <div class="price">$15.99/-</div>
            </div>
        </div>
        <div class="cart-item">
            <span class="fas fa-times"></span>
            <img src="images/cart-item-3.png" alt="">
            <div class="content">
                <h3>cart item 03</h3>
                <div class="price">$15.99/-</div>
            </div>
        </div>
        <div class="cart-item">
            <span class="fas fa-times"></span>
            <img src="images/cart-item-4.png" alt="">
            <div class="content">
                <h3>cart item 04</h3>
                <div class="price">$15.99/-</div>
            </div>
        </div>
        <a href="#" class="btn">checkout now</a>
    </div>

</header>



<!-- custom js file link  -->
<script src="js/script.js"></script>