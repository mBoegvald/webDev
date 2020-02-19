<?php

    //Validation

    if(isset($_POST['txtEmail']) && isset($_POST['txtPassword'])){
        $sCorrectEmail = 'a@a.com';
        $sCorrectPassword = '12345';
        $sUserEmail = $_POST['txtEmail'];
        $sUserPassword = $_POST['txtPassword'];

        if ( $sCorrectEmail == $sUserEmail && $sCorrectPassword == $sUserPassword) {
            //To start using sessions/cookies you must start the session

            session_start();
            $_SESSION['sEmail'] = $sUserEmail;
            header('Location: admin.php');
            exit();
        }
    }
    //Connect to the database

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<form action="login.php" method="POST">
    <input type="text" name="txtEmail" placeholder="Email">
    <input type="text" name="txtPassword" placeholder="Password">
    <button>Login</button>
</form>
    
</body>
</html>