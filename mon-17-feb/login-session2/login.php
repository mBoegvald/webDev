<?php

    if(isset($_POST['txtUsername']) && isset($_POST['txtPassword'])){
        $sCorrectPhone = "27890855";
        $sCorrectEmail = 'a@a.com';
        $sCorrectPassword = '123';
        $sName = 'Miklas';

        if ( $sCorrectPhone == $_POST['txtUsername'] && $_POST['txtPassword'] == $sCorrectPassword || 
        $sCorrectEmail == $_POST['txtUsername'] && $_POST['txtPassword'] == $sCorrectPassword) {
            session_start();
            $_SESSION['sName'] = $sName;
            header('Location: admin.php');
            exit();
        }
}

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
    <input type="text" name="txtUsername">
    <input type="text" name="txtPassword">
    <button>Login</button>
</form>
    
</body>
</html>