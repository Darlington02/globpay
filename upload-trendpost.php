<?php 
    require_once("session-manager.php");
    include_once("db-manager.php");

    if(!SessionManager::isLoggedIn()){
        header("location:index.php");
      }
      
    $type = $_SESSION['type'];

    if($type == "user"){
        header("location:index.php");
    }

    if(isset($_POST['post'])){
        $title = $_POST['title'];
        $body = $_POST['body'];

        $sql = "INSERT INTO `trendposts`(`title`, `body`) VALUES ('$title','$body')";
        mysqli_query($cxn, $sql) or die(mysqli_error($cxn));

        $SQL = "UPDATE `users` SET `share_status`='pending'";
        mysqli_query($cxn, $SQL) or die(mysqli_error($cxn));

        echo "<script>
				alert('Your trendpost has been updated successfully');
				window.location.href='admin-dashboard.php';
			</script>
		";
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

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <style>
        body{
            background: #1e1e49;
            color: white;
        }
        .container{
            margin-top: 120px;
        }
    </style>

</head>
        <body>
            <main class="container">
            <h3 class="my-2 text-center heading-text text-bold">Upload Trend Post</h3>
                <form method="POST">
                    <div class="form-group">
                        <label for="inputAddress">Title</label>
                        <input type="text" class="form-control col-md-11" name="title" id="inputEmail" placeholder="Input the Post title here!" required>
                    </div>

                    <label for="exampleFormControlTextarea1">Body</label>
                    <div class="form-inline mt-3">
                        <textarea class="form-control" name="body" id="exampleFormControlTextarea1" rows="20"
                            cols="130">
                        </textarea>
                    </div>
                    <button type="submit" name="post" class="btn btn-primary mt-3">Upload Post</button>
                </form>
            </main>
        </body>
    
    <?php include_once('footer.php'); ?>

    </html>