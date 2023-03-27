<?php
session_start();
if (!$_SESSION['logedIn']) {
    header('location:login.php');
}
if ($_GET['logout'] == true) {
    session_destroy();
    header("location:login.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="./assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">
</head>

<body>
    <section class="welcome">
        <div>
            <h1 class="welcome-msg">Welcome - <?php echo $_SESSION['user']['fname'] ?></h1>
            <div class="btn-group">
                <a href="/welcome.php?logout=true" class="logout-btn">Logout</a>

            </div>
        </div>

    </section>

</body>

</html>