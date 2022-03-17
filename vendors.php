<?php

    include_once("db-manager.php");
    require_once('session-manager.php');

    $type = $_SESSION["type"];

    if(!SessionManager::isLoggedIn()){
        header("location:index.php");
    }

    $SQL = "SELECT * FROM `users` WHERE `type` = 'vendor'";
        $result = mysqli_query($cxn, $SQL) or die(mysqli_error($cxn));

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
        <h3 class="my-2 text-center heading-text text-bold mt-5">Globpay Vendors</h3>
        <p>NB: Please contact any of our official vendors below, to purchase your signup coupons.</p>
        <div>
            <ul class="list-group">
                <?php
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)) {
                    extract($row);

                    echo '<li class="list-group-item"><a href="https://wa.me/+234'; echo $phone; echo '?text=Hello+I+want+to+purchase+a+Globpay+coupon,+my name+is+________________">'; echo $name; echo '</a> 
                    </li>';

                    }
                }else{
                    echo '
                    <div class="text-center">
                        <h5>oops..no vendors yet</h5>
                    </div>';
                }
                ?>
            </ul>
        </div>
    </main>

<?php 
    include_once('footer.php');
?>
</body>
</html>
 