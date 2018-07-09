<?php
require_once('./connect.php');
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_array($result)) {
        $user[] = $row;
    }
    // echo $user[0]['email'];
    // echo mysqli_num_rows($result);
    if (isset($user[0]['email'])) {
        if ($user[0]['email'] === $email) {
            if ($user[0]['password'] === $password) {
                session_start();
                $_SESSION['email'] = $email;
                echo 1;
                // header('Location: index.php');
            } else {
                echo 'The password is wrong';
            }
        } else {
            echo 'This email doesn\'t exist';
        }
    } else {
        echo 'This email doesn\'t exist';
    }
}
?>