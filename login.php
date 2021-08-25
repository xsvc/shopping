<?php
require_once 'config.php';

// This checks if the user has pressed the login button on the index page.
if (isset($_POST['login'])) {
    // Gets the data the user typed in the fields in the login and sanitises the data
    // uses function in template
    $username = sanitise_data($_POST['username']);
    $password = sanitise_data($_POST['password']);

    $query = $conn->query("SELECT COUNT(*) as count, * FROM `user` WHERE `username`='$username'");
    $row = $query->fetchArray();
    $count = $row['count'];
    if ($count > 0) {
        if (password_verify($password, $row['password'])) {
            $_SESSION["user_id"] = $row[1];
            $_SESSION["name"] = $row[4];
            $_SESSION["username"] = $row[2];
            $_SESSION['level'] = $row[6];
            header("location:profile.php");
        } else {
            echo "<div class='alert alert-danger'>Invalid username or password</div>";
        }
    }
}
?>