<?php
session_start();
require('config.inc.php');
$currentUser = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : "";
$userMail = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : "";
$currentUserID = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "";
if (isset($_POST['logout'])) {
    // remove all session variable 
    session_unset();
    // remove session
    session_destroy();
    header("Location: $front");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Application Login tp1 cyber securite.">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <meta name="theme-color" content="#edf0f2">
    <link rel="manifest" href="manifest.webmanifest">
    <link rel="stylesheet" href="styles/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>App login</title>
</head>
<noscript>
    <div class="alert alert-danger d-flex justify-content-around align-items-center" role="alert">
        <img src="uploads/jsdisabled.gif" title="js disable" alt="jsdisable" class="icon ic_s_error" />
        <h3>
            JavaScript doit être activé !
        </h3>
    </div>
</noscript>

<body>
    <header>
        <nav class="topnav">
            <span>
                <a href="<?= $front; ?>"><img width="50" height="50" src="./uploads/logo.png" alt="logo-iut"></a>
            </span>
            <?php if (isset($_SESSION['user_email'])) : ?>
                <span>
                    <a href='<?= $front; ?>/compteInfo.php'><i class='fa-solid fa-user'></i> Mon compte</a>
                </span>
                <form class='pe-4' method='post'><button class='btn btn-outline-secondary' title='Logout' type='submit' name='logout' value='Logout'><i class='fa-solid fa-right-from-bracket'></i></button></form>
            <?php endif; ?>
        </nav>
    </header>