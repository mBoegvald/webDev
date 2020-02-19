<?php
    //Validation

    //Connect to the database

    $sCorrectEmail = 'a@a.com';
    $sCorrectPassword = '12345';
    $sUserEmail = $_POST['txtEmail'];
    $sUserPassword = $_POST['txtPassword'];

    if ( $sCorrectEmail == $sUserEmail && $sCorrectPassword == $sUserPassword) {
        //To start using sessions/cookies you must start the session

        session_start();
        $_SESSION['email'] = $sUserEmail;
        header('Location: admin.php');
        exit();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
</head>
<body>

<h1>Login</h1>

<form action="login.php" method="POST">
    <input type="text" name="txtEmail" placeholder="Email">
    <input type="text" name="txtPassword" placeholder="Password">
    <button>Login</button>
</form>
    
</body>
</html>