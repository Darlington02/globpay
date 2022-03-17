<?php

	include_once('session-manager.php');
	include_once('db-manager.php');

	$user = $_SESSION['user'];

	$SQL = "SELECT * FROM `users` WHERE `id` = '$user'";
	$result = mysqli_query($cxn, $SQL) or die(mysqli_error($cxn));
	while($row = mysqli_fetch_assoc($result)){
		extract($row);
	}

	// calculate total earnings
	$total_earnings = $ref_bonus + $trendpost_bonus;

	// handle daily bonus
	if(isset($_POST['daily_bonus'])){

		// check that the user has not withdrawn today
		$today = date("y-m-d");
		$end_date = date("y-m-d", strtotime($start. " +14 days"));

		$date1 = strtotime($end_date);  
		$date2 = strtotime($today);

		if($date2 >= $date1){
			$withdraw = 'yes';
		}else{
			$withdraw = 'no';
		}

		if($user_package == "Musk"){
			$bonus = 500;
		}
		if($user_package == "Platinum"){
			$bonus = 1500;
		}
	
		// Update user bonus
		$SQL = "UPDATE `users` SET `daily_bonus`= `daily_bonus` + '$bonus' WHERE '$user' = `id`";
		mysqli_query($cxn, $SQL) or die(mysqli_error($cxn));
	
		echo "<script>
				alert('Your daily bonus has been credited successfully');
				window.location.href='dashboard.php';
			</script>
		";
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="css/dashboard.css">

	<title>Globpay - Dashboard</title>
</head>
<body>

	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav style="background: #212157;">
			<a href="index.php" class="logo">
				<img src="images/logo.png" width="80" alt="">
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1 style="color: white">Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="index.php">Home</a>
						</li>
					</ul>
				</div>
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bxs-dollar-circle' ></i>
					<span class="text">
						<h3>NGN <?php echo $total_earnings ?></h3>
						<p>Total Balance</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-edit-alt' ></i>
					<span class="text">
						<h3>NGN <?php echo $trendpost_bonus ?></h3>
						<a href="trendpost.php?package=<?php echo $user_package ?>"><p>Share Trendpost</p></a>
					</span>
				</li>
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<h3>NGN <?php echo $ref_bonus ?></h3>
						<a href="affiliate_earnings.php"><p>Affiliate Earnings</p></a>
					</span>
				</li>
				<!-- <li>
					<i class='bx bxs-calendar-check' style="background: lightgreen;"></i>
					<span class="text">
						<h3>NGN <?php echo $daily_bonus ?></h3>
						<form method="post">
							<input type="submit" name="daily_bonus" value="Click To Earn Daily Bonus" style="background: transparent; border: none; color: blue; text-decoration: underline; cursor: pointer">
						</form>
					</span>
				</li> -->
			</ul>

			<h2 style="margin-top: 20px; text-align: center; color: white">Account</h2>
			<ul class="box-info">
				<li>
					<i class='bx bxs-edit-alt' ></i>
					<span class="text">
					<a href="reset-password.php"><p>Reset password</p></a>
					</span>
				</li>
				<li>
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">
						<a href="account_details.php"><p>Update Account Details</p></a>
					</span>
				</li>
				<li>
					<i class='bx bxs-dollar-circle' ></i>
					<span class="text">
					<a href="my-withdrawals.php"><p>Total Withdrawals</p></a>
					</span>
				</li>
			</ul>

			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Recent Referrals</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table>
						<thead>
							<tr>
								<th>Name</th>
								<th>Package</th>
							</tr>
						</thead>

						<?php
							$sql = "SELECT * FROM `users` WHERE `upline` = '$user'";
							$result = mysqli_query($cxn, $sql) or die(mysqli_error($cxn));

							if(mysqli_num_rows($result) > 0){
								while($row = mysqli_fetch_assoc($result)) {
								extract($row);

								echo "<tbody>
									<tr>
										<td>
											<p>$name</p>
										</td>
										<td>$user_package</td>
									</tr>
								</tbody>";
								}
							}
						?>
					</table>
				</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->

</body>
</html>