<?php

if(isset($_POST['txtEmail']) && isset($_POST['txtPassword'])) {
    $sData = file_get_contents('user.json');
    $jData = json_decode($sData);
    $sUserEmail = $_POST['txtEmail'];
    $sUserPassword = $_POST['txtPassword'];
    foreach($jData->users as $jUser){ 
        if($jUser->email == $sUserEmail && $jUser->password == $sUserPassword){
            if(!$jUser->verified == 1){
                header('Location: login.php');
                exit();
            }
             session_start();
             $_SESSION['sEmail'] = $sUserEmail;
             header('Location: admin.php');
             exit();
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="styles/app.css">
  <title>Login</title>
</head>
<body>
  
  <nav>
    <a class="active" href="index.php" id="logo">
      <img src="momondo-logo.png" alt="Momondo">
    </a>
    <a href="">fly</a>
    <a href="">hotel</a>
    <a href="">car</a>
    <a href="">trips</a>
    <a href="">discover</a>
    <a href="mytrips.php">my trips</a>
    <a href="admin.php">Admin</a>
    <a href="login.php">login</a>
  </nav>
  <h1 id="loginTitle">Login</h1>
    <div id="login_con">
        <form action="login.php" method="POST">
            <input name="txtEmail" type="text" placeholder="Email">
            <input name="txtPassword" type="password" placeholder="Password">
            <button>Login</button>
        </form> 
    </div>
<?php
$sInjectJavascript = 'login';
require_once('components/footer.php');
?>