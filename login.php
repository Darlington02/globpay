<?php

    require_once("session-manager.php");

    if(SessionManager::isLoggedIn()){
        header("location:index.php");
    }

    if(isset($_POST['login'])){
    //perform the login
        switch(SessionManager::login($_POST['email'], $_POST['pwd'])){
            case "admin":
                header("location:admin-dashboard.php");
                break;
            case "user":
                header("location:dashboard.php");
                break;
            case "email error":
                $error["err_email"] = "your email is incorrect";
                break;
            default:
            $error["err_pwd"] = "your password is incorrect";      
        }  
    }

?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Globpay - Login</title>

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
                <h3>Login</h3>
                <div class="inputBox">
                    <span class="fas fa-envelope"></span>
                    <input type="email" name="email" placeholder="email">
                    <p style="color: white"><?php echo (isset($error['err_email']) ? $error['err_email'] : ""); ?></p>
                </div>
                <div class="inputBox">
                    <span class="fas fa-phone"></span>
                    <input type="password" name="pwd" placeholder="password">
                    <p style="color: white"><?php echo (isset($error['err_pwd']) ? $error['err_pwd'] : ""); ?></p>
                </div>
                <input type="submit" name="login" value="Login" class="btn">
            </form>

        </div>

    </section>

    <!-- footer section starts  -->
    <?php include_once("footer.php") ?>
    </body>

</html>