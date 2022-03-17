<?php

    include_once("db-manager.php");
    require_once('session-manager.php');

    $type = $_SESSION['type'];


    if(!SessionManager::isLoggedIn()){
        header("location:index.php");
    }

    if($type !== "super" AND $type !== "admin"){
        header("location:index.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Globpay - Home</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <style>
        body{
            background: #1e1e49;
            color: white;
        }
        a{
            text-decoration: none;
            color: white;
        }
        .container{
            margin-top: 150px;
        }
        .small-card{
            width: 100%;
            margin: 40px;
            margin-top: 30px;
            margin-bottom: 30px;
        }
        .list-group-item{
            background: #1e1e49;
        }
    </style>

</head>

    <body>
        <?php include_once('navbar.php'); ?>
        <main class="container">
        <small>Welcome, <?php $_SESSION['name'] ?></small>
        <ul class="list-group mt-3">
            <?php
                if($type = "super"){
                    echo '<li class="list-group-item"><a href="view-users.php"  class="text-dark">View all Users</a></li> 
                    
                    <li class="list-group-item"><a href="view-admins.php"  class="text-dark">View all Admins</a></li>

                    <li class="list-group-item"><a href="vendors.php"  class="text-dark">View all Vendors</a></li>
                    
                    <li class="list-group-item"><a href="upload-trendpost.php"  class="text-dark">Upload Trendpost</a></li>';
                }
            ?>

            <h3 class="my-2 text-center heading-text text-bold">WITHDRAWAL SECTION</h3>
            <li class="list-group-item"><a href="pending-withdrawals.php?type=Referral" class="text-dark">Affiliate Withdrawals</a></li>
            <li class="list-group-item"><a href="pending-withdrawals.php?type=Non-referral" class="text-dark">Non-affiliate Withdrawals</a></li>
            
            <h3 class="my-2 text-center heading-text text-bold">COUPON SECTION</h3>
             <li class="list-group-item"><a href="coupon-generator.php"  class="text-dark">Generate Coupon Codes</a></li>
            <li class="list-group-item"><a href="coupon-page.php?package=Musk&&id=" class="text-dark">Musk Coupons</a></li>
            <li class="list-group-item"><a href="coupon-page.php?package=Platinum&&id=" class="text-dark">Platinum Coupons</a></li>
        </ul>
        </main>
    </body>

    <?php include_once("footer.php"); ?>

</html>