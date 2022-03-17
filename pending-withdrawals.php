<?php 

    include_once('db-manager.php');
    require_once('session-manager.php');

    $type = $_GET['type'];

    if(!SessionManager::isLoggedIn()){
        header("location:login.php");
    }
    
    $id = $_SESSION['user'];
    $email = $_SESSION['email'];
    
    $sql = "SELECT * FROM `withdrawals`, `users` WHERE `withdrawal_type` = '$type' AND `user_email` = `email` AND `status` = 'pending'";
    $result = mysqli_query($cxn, $sql) or die(mysqli_error($cxn));


    if(isset($_POST['paid'])){

        $withdrawal_id = $_POST['withdrawal_id'];

        $SQL = "UPDATE `withdrawals` SET `status`='paid' WHERE `withdrawal_id` = '$withdrawal_id'";
        mysqli_query($cxn, $SQL) or die(mysqli_error($cxn));

        echo "<script>
				alert('The transaction has been marked as paid');
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
        .container{
            margin-top: 150px;
            margin-bottom: 100px;
        }
        a{
            text-decoration: none;
            color: white;
        }
        table{
            border-collapse: collapse;
        }
        thead tr{
            border-top: 1px solid gainsboro;
            border-bottom: 1px solid gainsboro;
        }
        thead td{
            font-weight: 700;
        }
        td{
            padding: .5rem 1rem;
            font-size: 18px;
        }
    </style>

</head>



<body>
    <?php include_once('navbar.php'); ?>
    <main class="container">
        <h3 class="my-2 text-center heading-text text-bold">My Withdrawals</h3>
        <table width="100%">
            <thead>
                <tr>
                    <td>Name</td>
                    <td>Account No.</td>
                    <td>Bank</td>
                    <td>Amount</td>
                    <td>Action</td>
                </tr>
            </thead>
                    
            <?php
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)) {
                    extract($row);
                        echo '
                            <tbody>
                                <tr>
                                    <td>'; echo $name; echo '</td>
                                    <td>'; echo $account_number; echo '</td>
                                    <td>'; echo $bank; echo '</td>
                                    <td>'; echo $amount; echo '</td>
                                    <td>
                                        <form method="post">
                                            <input type="hidden" name="withdrawal_id" value="'; echo $withdrawal_id; echo '">
                                            <button type="submit" name="paid" class="btn btn-primary mt-3">Confirm Paid</button>
                                        </form>
                                    </td>
                                </tr>
                        
                        ';
                    }
                }else{
                    echo '
                    <div class="text-center">
                        <h5>oops..no withdrawals presently</h5>
                        <img src="images/coin.png" width="300" alt="">
                    </div>';
                }
            ?>
           </tbody>
        </table>
    </main>
</body>

<?php 
    include_once('footer.php');
?>