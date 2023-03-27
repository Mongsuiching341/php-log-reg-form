<?php
session_start();
// session_destroy();
include_once './functions.php';

print_r($_SESSION['user']);

if (isset($_POST['login'])) {
    $email = $_POST['logEmail'];
    $password = $_POST['logPass'];

    $user = new LoginUser($email, $password);
    $user->checkUser();
    if ($user->logedIn) {
        $_SESSION['logedIn'] = true;
        $_SESSION['user'] = $user->userData;
        header("location:welcome.php");
    } else {
        $errorMsg =  'user data is invalid';
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn</title>
    <link rel="stylesheet" href="./assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">
</head>

<body>
    <section class="login-form">
        <div class="log-head">
            <h2>Login</h2>
            <p>Access your premium account!</p>
            <small class="error-msg"><?php echo $errorMsg ?? '' ?></small>
        </div>
        <form action="./login.php" method="post">
            <label for="loginemail">Email</label>
            <input type="email" name="logEmail" id="logEmail">
            <label for="password">Password</label>
            <input type="password" name="logPass" id="logPass">
            <div class="btn-group">
                <button type="submit" name="login">Log In</button>
                <div class="wow">
                    <p>Don't have an accout? <a href="./index.php" class="log-btn">Sign Up</a></p>
                </div>
            </div>

        </form>
    </section>
</body>

</html>