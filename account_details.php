<?php

    require_once('session-manager.php');
    include_once('db-manager.php');
    
    if(!SessionManager::isLoggedIn()){
        header("location:login.php");
    }

    $user = $_SESSION['user'];

    if(isset($_POST['submit'])){
        $account_number = $_POST['account_number'];
        $bank = $_POST['bank'];
        
        $sql = "UPDATE `users` SET `bank`='$bank',`account_number`='$account_number' WHERE `id` = '$user'";
        mysqli_query($cxn, $sql) or die(mysqli_error($cxn));

        echo "<script>alert('Your account details was updated successfully!')</script>";
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
        <h2 class="text-dark mb-3 text-center">Update account details</h2>
        <p class="warning">NB: Ensure you use an account that matches your specified name, or you won't be paid!</p>

        <form method="post">
            <div class="form-group text-dark">
                <label for="inlineFormCustomSelect">Account Number</label>
                <input type="number" name="account_number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter account number" required>
            </div>
            <div class="form-group text-dark">
                <label for="inlineFormCustomSelect">Bank</label>
                <input type="text" name="bank" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Bank Name" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary btn-md mt-2">Update</button>
        </form>
    </main>
</body>

<footer>
    <?php include_once('footer.php'); ?>
</footer>

</html>