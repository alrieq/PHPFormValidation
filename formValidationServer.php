<?php
if ($_SERVER['REQUEST_METHOD'] != 'POST' ){
    header($_SERVER["SERVER_PROTOCOL"]." 405 Method Not Allowed", true, 405);
    die("<h1>Error: 405 Method Not Allowed</h1>");
}

// Clean the input (remove extra whitespaces)
$userName = trim($_POST["uname"]);
$email = trim($_POST["email"]);
$comment = $_POST["comment"];

if (empty($userName) || empty($email) || empty($comment)) {
    echo "<p>Error: User name, email, and comment data are required.</p>";
    return;
}

// User name validation
$unameLength = strlen($userName);
$unameRegExp = "/^([a-zA-Z0-9])$/";
if (count(explode(' ', $userName)) > 1) {
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

// comment validation:
$commentRegExp = "/^(?=.*[A-Za-z0-9])[A-Za-z\d@$!%*#?& ]{1,150}$/";

if (preg_match($commentRegExp, $comment)) {
    echo "<p>Comment is valid</p>";
} else {
    echo "<p>Error: Comment must be less than 150 characters, at least one letter or one digit.</p>";
}
