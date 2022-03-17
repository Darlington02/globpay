<?php

    require_once("session-manager.php");
    include_once("db-manager.php");

    include_once('navbar.php');

    $user = $_SESSION['user'];
    $package = $_GET["package"];

    if(isset($_POST['finished'])){

        $status = 'shared';

        if($package == 'Musk'){
            $balance = 300;
        }
        if($package == 'Platinum'){
            $balance = 500;
        }

        $SQL = "UPDATE `users` SET `trendpost_bonus`=`trendpost_bonus`+'$balance',`share_status`='shared' WHERE `id` = '$user'";
        mysqli_query($cxn, $SQL) or die(mysqli_error($cxn));

        echo "<script>
				alert('Your trendpost bonus has been credited successfully');
				window.location.href='dashboard.php';
			</script>
        ";
   
    }

    $sql = "SELECT * FROM `trendposts`";
    $result = mysqli_query($cxn, $sql) or die(mysqli_error($cxn));

    while($row = mysqli_fetch_assoc($result)){
        extract($row);
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

    <!-- share this link -->
    <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=60076f4ea0fed60018ecd8ee&product=inline-share-buttons" async="async"></script>

    <style>
        body{
            background: #1e1e49;
            color: white;
            line-height: 50px;
            font-size: 20px;
        }
        a{
            text-decoration: none;
            color: white;
        }
        .container{
            margin-top: 150px;
        }
        .btn-primary{
            height: 45px;
            margin-bottom: 50px;
            margin-top: 30px;
        }
        .warning{
            background: #262672;;
            padding: 10px;
            margin-top: 30px;
            margin-bottom: 30px;
            border-radius: 15px;
            font-size: 17px;
        }
    </style>

</head>

<body>
    <main class="container">
        <div class="mt-4">
            <h1 class="font-weight-bold" style="margin-bottom: 30px;"><?php echo $title ?></h1>
            <div class="mt-3">
                <p><?php echo $body ?></p>
            </div>

            <div class="sharethis-inline-share-buttons text-left"></div>

            <?php
                $SQL = "SELECT * FROM `users` WHERE `id` = '$user'";
                $results = mysqli_query($cxn, $SQL) or die(mysqli_error($cxn));
                mysqli_data_seek($results, 0);
                while($rows = mysqli_fetch_assoc($results)){
                    extract($rows);
                }

                if(SessionManager::isLoggedIn() && $share_status == "pending"){
                    echo ' 
                    <p class="warning">NB: Confirm completion of task by hitting the Done button, and your trendpost bonus will be updated automatically.</b></p>

                    <form method="post">
                        <button type="submit" class="btn btn-primary btn-md btn-block mt-4" name="finished">Done</button>
                    </form>';
                }
            ?>
            
        </div>    
    </main>
</body>

</html>

<?php include_once('footer.php'); ?>