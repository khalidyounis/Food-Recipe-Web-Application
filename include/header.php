<?php

// creates an output buffer
ob_start();

// Start the user session
session_start();

// Call the config.php
include('include/config.php');

// Get the url file name
$filename = basename($_SERVER['PHP_SELF'], '.php');

// This function is used to prevent cross-site scripting (XSS) and is an attack when a bad actor attempts to inject malicious code onto the website
function _e($string)
{
    echo htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>

<html lang="en">
<!-- container for metadata -->

<head>
    <meta charset="UTF-8" />
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="include/assets/css/bootstrap.min.css" />
    <!-- Custom CSS-->
    <link href="include/assets/css/style.css" rel="stylesheet" type="text/css" media="only screen" />
    <!-- Fontawesome CSS-->
    <link rel="stylesheet" href="include/assets/fonts/font-awesome/css/font-awesome.min.css" />
    <!-- Sweetalert2 CSS-->
    <link rel="stylesheet" href="include/assets/css/sweetalert2.min.css" media="all">
    <meta name="description" content="Easy Recipes">
    <meta name="keywords" content="easy recipes, recipes, food, main, starter, dessert">
    <meta name="robots" content="noodp" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="HandheldFriendly" content="true">
    <!-- Content Security Policy (CSP) helps to ensure any content loaded in the page is trusted by the site owner. CSPs mitigate cross-site scripting (XSS) attacks-->
    <meta http-equiv="Content-Security-Policy" content="default-src *; style-src 'self' 'unsafe-inline'; script-src 'self' 'unsafe-inline' 'unsafe-eval' http://www.google.com">
    <link rel="apple-touch-icon" sizes="57x57" href="images/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="images/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="images/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="images/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="images/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="images/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="images/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="512x512" href="images/android-chrome-512x512.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="images/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
    <link rel="manifest" href="images/manifest.json">
    <meta name="msapplication-TileColor" content="#603F8B">
    <meta name="msapplication-TileImage" content="images/ms-icon-144x144.png">
    <meta name="theme-color" content="#603F8B" />
    <title>Easy Recipes: Recipes for your taste</title>
</head>
<!-- the body tag for the main contents -->

<body>

    <header class="header_section">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg custom_nav-container ">
                <a class="navbar-brand white-img" href="index"> <img alt="Recipes" class="logo" src="images/website_logo.webp"></img> </a><span class="web-title">Recipes for your taste</span>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class=""> </span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav" role="tablist">
                        <li class="nav-item <?php if ($filename == 'index') {
                                                _e("nav-active");
                                            } ?>" role="tab">
                            <a class="nav-link" href="index">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item <?php if ($filename == 'about') {
                                                _e("nav-active");
                                            } ?>" role="tab">
                            <a class="nav-link" href="about">About</a>
                        </li>
                        <li class="nav-item <?php if ($filename == 'contact') {
                                                _e("nav-active");
                                            } ?>" role="tab">
                            <a class="nav-link" href="contact">Contact</a>
                        </li>

                        <?php

                        // Check if the user is logged in
                        if (!isset($_SESSION['user_logged_in'])) {

                        ?>
                            <li class="nav-item" role="tab">
                                <a class="nav-link" href="login">Login</a>
                            </li>
                        <?php } else {
                        ?>

                            <li class="nav-item dropdown" role="tab">
                                <a class="dropdown-toggle user-nav lowercase mx-3" data-toggle="dropdown" href="#">
                                    <span><?php _e($_SESSION['email']); ?></span></a>
                                </a>

                                <ul class="dropdown-menu dropdown-user user-dropdown-menu">
                                    <li><a href="account-settings.php" role="tab"><i class="fa fa-user fa-fw"></i> Account Settings</a></li>
                                    <li><a href="include/logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
                                </ul>
                            </li>


                        <?php
                        }
                        ?>
                        <form action="search-results.php" method="GET">
                            <div class="search-form">
                                <i class="fa fa-search"></i>

                                <input class="form-control search-form-input" name="keyword" value="<?php if (!empty($query)) {
                                                                                                        _e($query);
                                                                                                    } ?>" placeholder="Enter food name">
                            </div>
                        </form>

                    </ul>
                </div>
            </nav>
        </div>
    </header>