<?php
if ($_SERVER['REQUEST_METHOD'] != 'POST' ){
    header($_SERVER["SERVER_PROTOCOL"]." 405 Method Not Allowed", true, 405);
    die("<h1>Error: 405 Method Not Allowed</h1>");
}

// Clean the input (remove extra whitespaces)
$userName = trim($_POST["uname"]);
$email = trim($_POST["email"]);
$password = $_POST["pw"];

if (empty($userName) || empty($email) || empty($password)) {
    echo "<p>Error: User name, email, and password data are required.</p>";
    return;
}

// User name validation
$unameLength = strlen($userName);
$unameRegExp = "/^([a-zA-Z0-9_-]){8,32}$/";
if (preg_match($unameRegExp, $userName)) {
    echo "<p>User name is valid</p>";
} else {
    echo "<p>Error: Invalid user name. User name must be between 8 and 32 characters and may contain a combination of letters and numbers</p>";
}

// Email validation
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<p>Email address is valid.</p>";
} else {
    echo "<p>Error: Invalid email address.</p>";
}

// Password validation:
$passwordRegExp = "/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,32}$/";

if (preg_match($passwordRegExp, $password)) {
    echo "<p>Password is valid</p>";
} else {
    echo "<p>Error: Password must be between 8 and 32 characters, at least one letter, one digit, and one special character.</p>";
}
