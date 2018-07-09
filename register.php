<?php
require_once('./connect.php');
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    // echo $email;

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) >= 1) {
        echo '<span style="color: red;">error</span>';
    } else {
        $sql = "INSERT INTO users SET email='$email', password='$password'";
        if (mysqli_query($conn, $sql)) {
            echo 1;
        }
    }
}
?>