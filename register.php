<?php
require('connection.php'); // Ensure DB connection is available

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $pwd = $_POST["password"];
    $error = '';
    $success = '';

    // Check if the email already exists
    $check_query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($result) > 0) {
        $error = "❌ Email already registered. Try logging in!";
    } else{

        // Insert user data into the database
        $insert_query = "INSERT INTO users (email, pwd) VALUES ('$email', '$pwd')";
        if (mysqli_query($conn, $insert_query)) {
            $success = "✅ Registration successful! You can now <a href='login.php'>login here</a>.";
        } else {
            $error = "❌ Registration failed: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Account</title>
    <link rel="stylesheet" href="bootstrap.css">
</head>

<body>
    <div class="container mt-5">
        <h2>✨ Register a New Account ✨</h2>

        <?php if (!empty($error)): ?>
            <div style="color:red;"><?= $error ?></div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div style="color:green;"><?= $success ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="mb-3">
                <label>Email 📩</label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>

            <div class="mb-3">
                <label>Password 🔒</label>
                <input type="password" name="password" class="form-control" placeholder="Enter a password" required>
            </div>

            <button type="submit" class="btn btn-primary">Register 🚀</button>
        </form>
    </div>
</body>

</html>
