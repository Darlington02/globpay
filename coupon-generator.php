<?php

    require_once('session-manager.php');
    include_once('db-manager.php');

    $type = $_SESSION["type"];
    
    if(!SessionManager::isLoggedIn()){
        header("location:login.php");
    }

    if($type == "user"){
        header("location:index.php");
    }
    
    if(isset($_POST['generate'])){
        $package = $_POST['package'];
        $vendor = $_POST['vendor_id'];
        $repetition = $_POST['repetition'];

        for($i=0; $i<$repetition; $i++){
            $coupon_code = 'GLOB'.uniqid();

            $sql = "INSERT INTO `coupons`(`coupon`, `package`, `vendor_id`) VALUES ('$coupon_code','$package','$vendor')";
            mysqli_query($cxn, $sql) or die(mysqli_error($cxn));
        }
        echo "<script>alert('$package coupon successfully created')</script>";
        echo "<script>window.location='coupon-generator.php'</script>";
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
    </style> 

</head>

<body>
    <?php include_once('navbar.php'); ?>
    <main class="container">
        <h2 class="text-dark mb-3 text-center">Generate coupon</h2>

        <form method="post">
            <div class="form-group text-dark">
                <label for="inlineFormCustomSelect">Package Name</label>
                <select name="package" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                    <option selected>Choose...</option>
                    <option>Musk</option>
                    <option>Platinum</option>
                </select>
            </div>
            <div class="form-group text-dark">
                <label for="inlineFormCustomSelect">Vendor's ID</label>
                <input type="number" name="vendor_id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter id">
            </div>
            <div class="form-group text-dark">
                <label for="inlineFormCustomSelect">Number of codes to be generated</label>
                <input type="number" name="repetition" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Number of codes">
            </div>
            <button type="submit" name="generate" class="btn btn-primary btn-md mt-2">Generate</button>
        </form>
    </main>
</body>

<footer>
    <?php include_once('footer.php'); ?>
</footer>

</html>