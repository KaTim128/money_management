<?php
require('connection.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
} else {
    echo "✅ Welcome! Your User ID is: " . $_SESSION['user_id'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Money Manager 💸💰🪙</title>
    <link rel="icon" href="./images/coin.png">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <script defer src="./js/bootstrap.bundle.js"></script>
    <script src="./js/jquery-3.7.1.min.js"></script>
    <script defer src="./js/script.js"></script>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid justify-content-center">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link mx-2 my-1 <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php' || basename($_SERVER['PHP_SELF']) == 'percentage.php') ? 'active' : ''; ?>"
                        href="index.php">Money Manager</a>
                    <a class="nav-link mx-2 my-1 <?php echo basename($_SERVER['PHP_SELF']) == 'coin_flip.php' ? 'active' : ''; ?>"
                        href="coin_flip.php">Coin Flip</a>
                    <a class="nav-link mx-2 my-1 " href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>