<?php
session_start();

if ($_SESSION['logedIn']) {
    header('location:welcome.php');
}

include_once './functions.php';
$errors = [];

$message = '';
if (isset($_POST['reg'])) {



    if ($_POST['fname']) {
        $fname  = htmlspecialchars($_POST['fname']);
    } else {
        $errors['fname'] = 'input is required';
    }
    if ($_POST['lname']) {
        $lname  = htmlspecialchars($_POST['lname']);
    } else {
        $errors['lname'] = 'input is required';
    }
    if ($_POST['regemail']) {

        if (!filter_var($_POST['regemail'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'email is not valid';
        } else {
            $email  = htmlspecialchars($_POST['regemail']);
        }
    } else {
        $errors['email'] = 'input is required';
    }

    if ($_POST['password']) {
        $password  = htmlspecialchars($_POST['password']);
    } else {
        $errors['password'] = 'Password is required';
    }
    if ($_POST['confirmPassword']) {
        $confirmPassword  = htmlspecialchars($_POST['confirmPassword']);
    } else {
        $errors['confirmPassword'] = 'input is empty';
    }

    if (count($errors) > 0) {
        // print_r($errors);
    } else {
        $user = new UserRegister($fname, $lname, $email, $password, $confirmPassword);
        $user->addUser();
        // if ($user->errorMessage) {

        //     $message =  'wow';
        //     // echo $message;
        // } elseif ($user->successMsg) {
        //     // header("location:index.php");
        //     echo $user->successMsg;
        // } else {
        //     echo $user->passErrorMsg;
        // }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS Reset -->
    <link rel="stylesheet" href="./assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <!-- Milligram CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">
</head>

<body>
    <section class="reg-form">
        <div class="reg-heading">
            <h2>Create Account</h2>
            <P>Find your next opportunity!</P>
            <p class="success-msg"> <?php echo $user->successMsg ?? '' ?></p>
            <small class="error-msg"><?php echo $user->passErrorMsg ?? '' ?></small>
            <small class="error-msg"> <?php echo $user->errorMessage ?? '' ?></small>
        </div>
        <form action="/" method="post">
            <label for="fname">First Name</label>
            <small class="error-msg"><?php if ($errors['fname']) {
                                            echo $errors['fname'];
                                        } ?></small>
            <input type="text" name="fname" id="fname" value="<?php echo $_POST['fname'] ?? '' ?>">
            <label for="lname">Last Name</label>
            <small class="error-msg"><?php if ($errors['lname']) {
                                            echo $errors['lname'];
                                        } ?></small>
            <input type="text" name="lname" id="lname" value="<?php echo $_POST['lname'] ?? '' ?>">
            <label for="regemail">Email</label>
            <small class="error-msg"><?php if ($errors['email']) {
                                            echo $errors['email'];
                                        } ?></small>
            <input type="email" name="regemail" id="regemail" value="<?php echo $_POST['regemail'] ?? '' ?>">
            <label for="password">Password</label>
            <small class="error-msg"><?php if ($errors['password']) {
                                            echo $errors['password'];
                                        } ?></small>
            <input type="password" name="password" id="password" value="<?php echo $_POST['password'] ?? '' ?>">
            <label for="confirmPassword">Confirm Password</label>
            <small class="error-msg"><?php if ($errors['confirmPassword']) {
                                            echo $errors['confirmPassword'];
                                        } ?></small>
            <input type="password" name="confirmPassword" id="confirmPassword" value="<?php echo $_POST['confirmPassword'] ?? '' ?>">
            <div class="btn-group">
                <button type="submit" name="reg">Sign Up</button>
                <div class="wow">
                    <p>Already have an accout? <a href="./login.php" class="log-btn">Log In</a></p>
                </div>
            </div>
        </form>

    </section>

</body>

</html>