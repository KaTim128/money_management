<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'money_manager';
session_start();

$conn = mysqli_connect($dbhost, $dbuser, $dbpass);

if (!$conn) {
    die('Could not connect to MySQL: ' . mysqli_connect_error());
}

$sql_create_db = "CREATE DATABASE IF NOT EXISTS $dbname";
$result = mysqli_query($conn, $sql_create_db);

if (!$result) {
    die("Error creating database: " . mysqli_error($conn));
}

mysqli_select_db($conn, $dbname);

$sql_users = "CREATE TABLE IF NOT EXISTS users (
    user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    email TEXT NOT NULL,
    pwd TEXT NOT NULL,
    total_salary DECIMAL(10, 2) NULL,
    needs_percent INT NULL,
    wants_percent INT NULL,
    savings_percent INT NULL,
    needs_amount DECIMAL(10, 2)  NULL,
    wants_amount DECIMAL(10, 2)  NULL,
    savings_amount DECIMAL(10, 2)  NULL,
    want_cut INT NULL,
    goal_amount DECIMAL(10, 2) NULL
)";

$retval_salary = mysqli_query($conn, $sql_users);
if (!$retval_salary) {
    die('Could not create table users: ' . mysqli_error($conn));
}
?>