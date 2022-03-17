<?php
    include_once("session-manager.php");
    include_once("db-manager.php");

    $user_type = $_SESSION['type'];

    if(!SessionManager::isLoggedIn() && $user_type !== 'super'){
        header("location:login.php");
      }
    if($user_type !== 'super'){
        header("location:dashboard.php");
    }


    $id = $_GET['id'];
    $SQL = "SELECT * FROM `users` WHERE `id` = $id";
    $result = mysqli_query($cxn, $SQL) or die(mysqli_error($cxn));
    $row = mysqli_fetch_assoc($result);
    extract($row);

    if(isset($_POST['roles'])){

        $type = $_POST["role"];
        
        $sql = "UPDATE `users` SET `type`='$type' WHERE `id` = '$id'";

        mysqli_query($cxn, $sql) or die(mysqli_error($cxn));
        header("location:admin-dashboard.php");
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
        .container{
            color: gainsboro;
            margin-top: 170px;
            margin-bottom: 50px;
            padding: 50px;
            box-shadow: 0 50px 50px rgba(0,0,0,0.5);
            border-radius: 20px;
        }
    </style>

</head>

<body>
    <?php include_once("navbar.php"); ?>
    <main class="container">
        <div class="card my-5">
            <div class="card-header">
                Edit Admin Roles
            </div>
            <div class="card-body">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>?id=<?php echo $id ?>" method="post">
                <div class="form-check mt-2">
                    <input <?php echo ($type == 'super') ? "checked": ""?> class="form-check-input" type="radio" name="role" id="exampleRadios3" value="super">
                    <label class="form-check-label" for="exampleRadios3">
                        Super
                    </label>
                </div>

                <div class="form-check">
                <input <?php echo ($type == 'admin') ? "checked": ""?> class="form-check-input" type="radio" name="role" id="exampleRadios1" value="admin">
                    <label class="form-check-label" for="exampleRadios1">
                        Admin
                    </label>
                </div>

                <div class="form-check">
                <input <?php echo ($type == 'vendor') ? "checked": ""?> class="form-check-input" type="radio" name="role" id="exampleRadios1" value="vendor">
                    <label class="form-check-label" for="exampleRadios1">
                        Vendor
                    </label>
                </div>
        
                <div class="form-check mt-2">
                    <input <?php echo ($type == 'user') ? "checked": ""?> class="form-check-input" type="radio" name="role" id="exampleRadios3" value="user">
                    <label class="form-check-label" for="exampleRadios3">
                        User
                    </label>
                </div>
                
                <input type="submit" name="roles" class="btn btn-primary mt-4" value="Edit Roles">
                </form>
            </div>
        </div>
    </main>
</body>

<?php include_once("footer.php"); ?>

</html>