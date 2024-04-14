<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php if (!isset($title) || $title == ''): ?>
        <?php $title = "Bootstrap 5 Website Example"; ?>
    <?php endif; ?>
    <title><?php echo $title; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        .error {
            color: red;
            font-weight: 400;
            display: block;
        }
        .form-control.error {
            border-color: red;
            padding: .375rem .75rem;
        }
    </style>
</head>

<body>

    <div class="p-5 bg-primary text-white text-center">
        <?php if (!isset($pageHeading) || $pageHeading == ''): ?>
            <?php $pageHeading = "Bootstrap 5 Website Example"; ?>
        <?php endif; ?>
        <h1><?php echo $pageHeading; ?></h1>
    </div>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
            <?php
                function active($current_page) {
                    $url_array = explode("/", $_SERVER['REQUEST_URI']);
                    $url = end($url_array);

                    if ($current_page == $url) {
                        echo "active";
                    }
                }
            ?>
            <?php $end = ""; ?>
            <?php $urlArray = explode("/", $_SERVER['REQUEST_URI']); ?>
            <?php $end = $urlArray[count($urlArray)-1]; ?>
            <ul class="navbar-nav">
                <?php if(empty($_SESSION)) { ?>
                    <li class="nav-item">
                        <a class="nav-link <?php active("registration.php"); ?>" href="registration.php">Registration</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php active("login.php"); ?>" href="login.php">Login</a>
                    </li>
                <?php } ?>
                <?php if(!empty($_SESSION) && isset($_SESSION['loggedin']) && $_SESSION['loggedin']) { ?>
                    <li class="nav-item">
                        <a class="nav-link <?php active("dashboard.php"); ?>" href="dashboard.php">Dashboard</a>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
            </ul>
            <?php if(!empty($_SESSION) && isset($_SESSION['loggedin']) && $_SESSION['loggedin']) { ?>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="logout.php">Logout</a>
                    </li>
                </ul>
            <?php } ?>
        </div>
    </nav>