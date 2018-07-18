<?php
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// $email_help = null;
// $form_check = null;
// $submit_innerText = null;
$my_alert = null;
if (isset($_POST['submit']) && $_POST['submit'] === 'register') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // $email_help = 'We\'ll never share your email with anyone else.';
    // $form_check = null;
    // $submit_innerText = 'Register';

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) >= 1) {
        $my_alert = '<span style="color: red;">error</span>';
    } else {
        $sql = "INSERT INTO users SET email='$email', password='$password'";
        if (mysqli_query($conn, $sql)) {
            header('Location: admin/admin.php');
        }
    }
}

if (isset($_POST['submit']) && $_POST['submit'] === 'login') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // $email_help = '';
    // $form_check = '
    //     <div class="form-check">
    //         <input type="checkbox" class="form-check-input" id="dropdownCheck">
    //         <label class="form-check-label" for="dropdownCheck">Remember me</label>
    //         <hr>
    //         <a class="" href="#">New around here? Sign up</a> | <a class="" href="#">Forgot password?</a>   
    //     </div>
    // ';
    // $submit_innerText = 'Login';

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
                header('Location: admin/admin.php');
            } else {
                $my_alert = '<span style="color: red;">The password is wrong</span>';
            }
        } else {
            $my_alert = '<span style="color: red;">This email doesn\'t exist</span>';
        }
    } else {
        $my_alert = '<span style="color: red;">This email doesn\'t exist</span>';
    }
}
?>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="color: #333;">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="" method="POST" name="autorisationForm">
            <div class="modal-body">
                <?=$my_alert?>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
                    <small id="emailHelp" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>
                <div class="form-check">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="submit" name="submit"></button>
            </div>
        </form>
        </div>
    </div>
</div>