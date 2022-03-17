<?php

    require_once("session-manager.php");
    include_once("db-manager.php");

    if(!SessionManager::isLoggedIn()){
        header("location:index.php");
      }

    $name = $_SESSION['name'];
    $user = $_SESSION['user'];

    include_once("navbar.php");
    

    $SQL = "SELECT * FROM `users` WHERE `id` = $user";
    $result = mysqli_query($cxn, $SQL) or die(mysqli_error($cxn));

    while($row = mysqli_fetch_assoc($result)){
        extract($row);
    }

    $total_ref = mysqli_num_rows(mysqli_query($cxn, "SELECT * FROM `users` WHERE `upline` = '$user'"));

    if(isset($_POST['withdraw'])){

        $email = $_SESSION["email"];
        $type = 'Referral';
        $amount = $_POST['amount'];

        $sql = "INSERT INTO `withdrawals`(`user_email`, `withdrawal_type`, `amount`) VALUES ('$email','$type','$amount')";
        mysqli_query($cxn, $sql) or die(mysqli_error($cxn));

        $SQL = "UPDATE `users` SET `ref_bonus`= 0 WHERE '$user' = `id`";
        mysqli_query($cxn, $SQL) or die(mysqli_error($cxn));

        echo "<script>
                alert('Your withdrawal has been placed successfully')
            </script>
        ";
    
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
            margin-bottom: 150px;
        }
        .list-group-item{
            background: #1e1e49;
            height: 60px;
        }
        .first-list{
            height: 120px;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }
        .last-list{
            height: 70px;
            border-bottom-left-radius: 20px !important;
            border-bottom-right-radius: 20px !important;
        }
        .copy-button{
            margin-top: 10px;
            margin-left: 10px;
            margin-bottom: 10px;
        }
        @media(max-width: 960px){
            .copy-button{
                height: 35px;
                width: 100px;
            }
        }
    </style>

</head>
<body>
    <main class="container">
            <p>NB: Affiliate earnings are paid on Mondays and Fridays every week, endeavour to withdraw only during the stipulated days!</p>
            <li class="list-group-item first-list">
                <form class="form-inline">
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="myInput" class="sr-only">Referral Link</label>
                        <input type="text" class="form-control" id="myInput" value="localhost/globpay/signup.php?Ref=<?php echo $user ?>" readonly>
                    </div>
                    <button title="copy link to clipboard" type="submit" class="btn btn-primary copy-button" onclick="myFunction()">Copy</button>
                </form>
            </li>

            <li class="list-group-item">Referral Bonus: NGN <?php echo $ref_bonus ?></li>
            <li class="list-group-item">Total Referrals: <?php echo $total_ref ?></li>
            <li class="list-group-item last-list">
                <?php
                    if($ref_bonus > 99){
                    echo '<form class="form-inline" method="POST">
                                <input type="hidden" name="amount" value="'; echo $ref_bonus; echo '">
                                <button title="Withdraw Referral Bonus" type="submit" name="withdraw" class="btn btn-warning mb-2 btn-block">Withdraw</button>
                          </form>';
                    }
                    else{
                        echo '';
                    }
                ?>
            </li>
    </main>
</body>

<script>
    function myFunction() {
    /* Get the text field */
    var copyText = document.getElementById("myInput");

    /* Select the text field */
    copyText.select();
    copyText.setSelectionRange(0, 99999); /* For mobile devices */

    /* Copy the text inside the text field */
    document.execCommand("copy");

    /* Alert the copied text */
    alert("Copied the text: " + copyText.value);
    } 
</script>

<?php include_once('footer.php') ?>

</html>