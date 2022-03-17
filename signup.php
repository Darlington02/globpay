<?php

    // get referral id
    if(isset($_GET['Ref'])){
        $ref_id = $_GET['Ref'];
    }
    else{
        $ref_id = "none";
    }

    // handle form submit
    if(isset($_POST['submit'])){

        include_once('db-manager.php');

        $fullname = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['pwd'];
        $phone = $_POST['phone'];
        $user_upline = $_POST['upline'];
        $coupon = $_POST['coupon'];

        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // handle coupon activation
        $sql = "SELECT * FROM `coupons` WHERE `coupon` = '$coupon' AND `status` = 'unused'";
        $result= mysqli_query($cxn, $sql) or die(mysqli_error($cxn));

        while($row = mysqli_fetch_assoc($result)){
            extract($row);
        }

        if(mysqli_num_rows($result) == 0){
            echo "<script>alert('Wrong OR Used Coupon Code. Contact Your Vendor To Confirm Code!')</script>";
        }
        else {

            // insert user into database
            $sql = "INSERT INTO `users`(`name`, `email`, `password`, `phone`, `upline`, `user_package`) VALUES ('$fullname','$email','$password_hash','$phone','$user_upline','$package')";
            mysqli_query($cxn, $sql) or die(mysqli_error($cxn));

            echo "<script>
                alert('Your signup was successful, you can now login to your dashboard')
                window.location.href='login.php'
                </script>
            ";

            // set coupon status as used
            $coupon_sql = "UPDATE `coupons` SET `status`='used' WHERE `coupon` = '$coupon'";
            mysqli_query($cxn, $coupon_sql) or die(mysqli_error($cxn));

            // update direct referral bonus
            $SQL = "SELECT `upline`, `user_package` FROM `users` WHERE `id` = '$user_upline'";
            $result = mysqli_query($cxn, $SQL) or die(mysqli_error($cxn));
            while($row = mysqli_fetch_assoc($result)){
                extract($row);
            }

            if($user_package == 'Platinum' && $package == "Platinum"){
                $direct_upline_bonus = 3000;
                $indirect_upline_bonus = 200;
            }
            if($user_package == 'Platinum' && $package == "Musk"){
                $direct_upline_bonus = 1500;
                $indirect_upline_bonus = 100;
            }
            if($user_package == 'Musk' && $package == "Platinum"){
                $direct_upline_bonus = 1500;
                $indirect_upline_bonus = 200;
            }
            if($user_package == 'Musk' && $package == "Musk"){
                $direct_upline_bonus = 1500;
                $indirect_upline_bonus = 100;
            }

            $direct_referral_sql = "UPDATE `users` SET `ref_bonus`=`ref_bonus`+'$direct_upline_bonus' WHERE `id` = '$user_upline'";
            mysqli_query($cxn, $direct_referral_sql) or die(mysqli_error($cxn));

            // update indirect referral bonus
            $indirect_referral_sql = "UPDATE `users` SET `ref_bonus`=`ref_bonus`+'$indirect_upline_bonus' WHERE `id` = '$upline'";
            mysqli_query($cxn, $indirect_referral_sql) or die(mysqli_error($cxn));
        }
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Globpay -Signup</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>  
<!-- header section starts  -->
<?php include_once("navbar.php") ?>

<section class="contact" id="contact" style="margin-top: 140px">

    <div class="row">

        <form method="post">
            <h3>Sign up</h3>
            <div class="inputBox">
                <span class="fas fa-pen"></span>
                <input type="text" name="coupon" placeholder="coupon code" required>
            </div>
            <div class="inputBox">
                <span class="fas fa-user"></span>
                <input type="text" name="name" placeholder="name">
            </div>
            <div class="inputBox">
                <span class="fas fa-envelope"></span>
                <input type="email" name="email" placeholder="email">
            </div>
            <div class="inputBox">
                <span class="fas fa-eye"></span>
                <input type="password" name="pwd" placeholder="password">
            </div>
            <div class="inputBox">
                <span class="fas fa-phone"></span>
                <input type="text" name="phone" placeholder="phone">
            </div>
            <div class="inputBox">
                <p style="color: white; padding: 5px;">Upline:</p>
                <input type="text" name="upline" placeholder="Upline" value="<?php echo $ref_id ?>" readonly> 
            </div>
            <input type="submit" name="submit" value="Signup" class="btn">
        </form>

    </div>

</section>

<!-- footer section starts  -->
<?php include_once("footer.php") ?>


</body>

</html>