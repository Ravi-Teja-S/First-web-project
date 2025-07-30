<?php
$baseURL = "/TraditionalArtsWebsite";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRADITIONAL ARTS OF INDIA</title>
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="shortcut icon" href="./img/fotor-2025040321114.png" type="image/x-icon">
</head>

<body>
    <!-- Home Page Content -->
    <div class="home-page">
        <!-- Navigation Bar -->

        <nav>
            <img id="photo" src="./img/fotor-2025040321114.png" alt="" />

            <div id="logo">
                <img src="./img/T.gif" alt="">
            </div>
            <div id="menu-btn">MENU</div>
            <ul>
                <li class='li'><a href="<?php echo $baseURL; ?>/about-us">About Us</a></li>
                <li class='li'><a href="<?php echo $baseURL; ?>/gallery">Gallery</a></li>
                <li class='li'><a href="<?php echo $baseURL; ?>/shop-now">Shop Now</a></li>
                <li class='li'><a href="<?php echo $baseURL; ?>/contact-us">Contact Us</a></li>
            </ul>
        </nav>

      