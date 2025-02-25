<?php
require('connection.php');

if (isset($_SESSION['user_id']) && $_SESSION['user_id'] !== null) {
    echo "✅ User ID is set: " . $_SESSION['user_id'];
} else {
    echo "❌ User ID is null or not set.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];

    $select_query = "SELECT * FROM users WHERE email = '$email'";
    $result_query = mysqli_query($conn, $select_query);

    if ($row = mysqli_fetch_assoc($result_query)) {
        $password = $row['pwd'];
        if ($password == $pwd) {
            $_SESSION['user_id'] = $row['user_id'];
            header('Location: index.php');
            exit();
        } else {
            echo "❌ Invalid password!";
        }
    } else {
        echo "❌ Email not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./images/heart1.png">
    <title>Lock Screen 🔒</title>
    <link rel="stylesheet" href="bootstrap.css">
    <script defer src="bootstrap.bundle.js"></script>
    <script src="jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form action="" method="post">
        <h6>Enter Email to Continue:</h6>
        <input type="email" name="email" class="form-control w-100" required>
        <h6>Enter Password to Continue:</h6>
        <input type="password" name="pwd" class="form-control w-100" required>
        <div>
            <button type="submit" class="btn btn-lock">Unlock 🔒</button>
        </div>
    </form>
    <a href="register.php">Register</a>
</body>

</html>