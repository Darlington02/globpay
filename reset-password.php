<?php

    require_once("session-manager.php");
    require_once('db-manager.php');

    if(!SessionManager::isLoggedIn()){

        if(!isset($_GET['code'])){
            exit("The link to the page is broken");
        }
    
        $code = $_GET['code'];
    
        $sql = "SELECT * FROM `reset_passwords` WHERE `code` = '$code'";
        $result = mysqli_query($cxn, $sql) or die(mysqli_error($cxn));
    
        if(mysqli_num_rows($result) == 0){
            exit("The link to the page is broken");
        }
    
        if(isset($_POST['submit'])){
            $password = $_POST['pwd'];
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $row = mysqli_fetch_array($result);
            $email = $row['email'];
    
            $update_sql = "UPDATE `users` SET `password`='$password_hash' WHERE `email` = '$email'";
            mysqli_query($cxn, $update_sql) or die(mysqli_error($cxn));
    
            if($update_sql){
                $remove = "DELETE FROM `reset_passwords` WHERE `code` = '$code'"; 
                mysqli_query($cxn, $remove) or die(mysqli_error($cxn));
        
                exit('Your password was updated successfully. click <a href="login.php">here</a> to login.');
            }else{
                exit('something went wrong. Please try again.');
            }
        
        }
      }else{

        if(isset($_POST['submit'])){
            $password = $_POST['pwd'];
            $confirm_password = $_POST['confirm_pwd'];
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $email = $_SESSION['email'];
            
            // IF PASSWORD MATCHES, EXECUTE QUERY
            if($password == $confirm_password){
                $SQL = "UPDATE `users` SET `password`='$password_hash' WHERE `email` = '$email'";
                mysqli_query($cxn, $SQL) or die(mysqli_error($cxn));
                
                echo "<script>
                        alert('Your password has been reset successfully');
                        window.location.href='dashboard.php';
                    </script>
                ";
            }else{
                $_SESSION["err_pwd"] = "your password does not match";
                header("location:reset-password.php");
            
            }
        }

      }
    

    include_once('navbar.php');
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

    <style>
        .container{
            color: gainsboro;
            margin-top: 170px;
            margin-bottom: 50px;
            padding: 50px;
            box-shadow: 0 50px 50px rgba(0,0,0,0.5);
            border-radius: 20px;
        }
        @media(max-width: 960px){
            .container{
                margin: 40px;
                margin-top: 130px;
            }
        }

        h2{
            font-size: 35px;
            margin: 20px;
            text-align: center;
        }
        label{
            display: block;
            font-size: 20px;
            margin: 10px;
        }
        input, select{
            width: 100%;
            height: 40px;
            border: none;
            outline: none;
            background: transparent;
            border-bottom: 2px solid gold;
            margin: 10px;
            font-size: 15px;
            color: white;
        }
        option{
            background: black;
        }
        .warning{
            font-weight: bold;
            color: red;
            text-align: center;
            margin-bottom: 20px;
        }
    </style> 

</head>

<body>
    <?php include_once('navbar.php'); ?>
    <main class="container">
        <form method="post">
            <div class="form-group text-dark">
                <label for="inlineFormCustomSelect">Password</label>
                <input type="text" name="pwd" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter password" required>
            </div>
            <div class="form-group text-dark">
                <label for="inlineFormCustomSelect">Confirm Password</label>
                <input type="text" name="confirm_pwd" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="confirm password" required>
                <?php  
                    if(isset($_SESSION['err_pwd'])){
                        echo ($_SESSION['err_pwd']);
                        unset($_SESSION['err_pwd']);
                    }
                ?>
            </div>
            <button type="submit" name="submit" class="btn btn-primary btn-md mt-2" style="margin-top: 20px;">Update</button>
        </form>
    </main>
</body>
  

<?php include_once('footer.php'); ?>