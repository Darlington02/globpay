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

</head>
<body>
    

<!-- header section -->
<?php include_once("navbar.php") ?>

<!-- home section starts  -->

<section class="home" id="home">
    <div class="overlay">
        <div class="content">
            <div>
                <h3>Globpay</h3>
                <p>Globpay  is an online skills acquisition centre that deals with teaching and empowering of  individual on both digital and physical skills. <br>We are also an affiliate marketing/Networking platform of which various individuals earn sales revenue from inviting friends/families to learn or purchase our skills pack. </p>
            </div>
            
            <div>
                <img src="images/learn.png" width="450px" />
            </div>
        </div>
    </div>
</section>

<!-- home section ends -->

<!-- about section starts  -->

<section class="about" id="about">

    <h1 class="heading"> <span>about</span> us </h1>

    <div class="row">

        <div class="image">
            <img src="images/about-img.jpg" alt="">
        </div>

        <div class="content">
            <h3>Why Globpay?</h3>
            <p>Globpay is an innovative creation that brings into existence two different programs on the 
                same software. It gives users the option to choose either participating as a single affiliate or participating as a group(team work) or as a non affiliate in order to earn✅</p>
            <p>We offer the biggest commissions, when compared to any other affiliate marketing platform in Nigeria, whether selling digital or physical products. Percentage for affiliates on each referral is are 60% commission.
            </p>
        </div>

    </div>

</section>

<!-- about section ends -->

<!-- menu section starts  -->

<section class="menu" id="menu">

    <h1 class="heading"> Our <span>Packages</span> </h1>

    <div class="box-container">

        <div class="box">
            <img src="images/coin.png" alt="">
            <h3 class="package-name">Musk package - NGN 2500</h3>
            <br>
            <h3>Daily Login - NGN 500</h3>
            <h3>Trendposts - NGN 300</h3>
            <h3>Daily Earnings - NGN 800</h3>
            <h3>Weekly Earnings: NGN 5600</h3>
            <h3>Monthly Earnings: NGN 22,400</h3>
            <h3>Min Withdrawal(Non-affiliate): NGN 20,000</h3>
            <a href="vendor.php" class="btn">Contact Vendor</a>
        </div>

        <div class="box">
            <img src="images/coin.png" alt="">
            <h3 class="package-name">Platinum package - NGN 5000</h3>
            <br>
            <h3>Daily Login - NGN 1500</h3>
            <h3>Trendposts - NGN 500</h3>
            <h3>Daily Earnings - NGN 2000</h3>
            <h3>Weekly Earnings: NGN 140,00</h3>
            <h3>Monthly Earnings: NGN 56,400</h3>
            <h3>Min Withdrawal(Non-affiliate): NGN 30,000</h3>
            <a href="vendor.php" class="btn">Contact Vendor</a>
        </div>
    </div>

</section>

<!-- menu section ends -->

<!-- review section starts  -->

<section class="review" id="review">

    <h1 class="heading"> What people <span>say</span> </h1>

    <div class="box-container">

        <div class="box">
            <img src="images/quote-img.png" alt="" class="quote">
            <p>Globpay is the all in one platform you need to earn money as you acquire new skills. Since i joined Globpay, my finances has seen a huge upgrade. </p>
            <img src="images/chisom.jpg" class="user" alt="">
            <h3>Chisom Ugochukwu</h3>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
        </div>

        <div class="box">
            <img src="images/quote-img.png" alt="" class="quote">
            <p>Through Globpay, i have greatly improved on my trading skills. I now properly understand Technical and Fundamental Analysis, and all these while earning money through affiliate marketing</p>
            <img src="images/victor.jpg" class="user" alt="">
            <h3>john Uneke</h3>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
        </div>
        
        <div class="box">
            <img src="images/quote-img.png" alt="" class="quote">
            <p>You can never get it wrong with Globpay. The first platform where you get to earn as you learn.<br> I particularly like the easy to navigate user interface which helps newbies easily find their way across the site.</p>
            <img src="images/faith.jpg" class="user" alt="">
            <h3>Faith Bassey</h3>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
        </div>

    </div>

</section>

<!-- review section ends -->

<!-- contact section starts  -->
<section class="contact" id="contact">

    <h1 class="heading"> <span>contact</span> us </h1>

    <div class="row">

        <form action="">
            <h3>get in touch</h3>
            <div class="inputBox">
                <span class="fas fa-user"></span>
                <input type="text" placeholder="name">
            </div>
            <div class="inputBox">
                <span class="fas fa-envelope"></span>
                <input type="email" placeholder="email">
            </div>
            <div class="inputBox">
                <span class="fas fa-pen"></span>
                <input type="text" placeholder="enter message">
            </div>
            <input type="submit" value="contact now" class="btn">
        </form>

    </div>

</section>

<?php include_once("footer.php") ?>

</body>
</html>