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

<h1 id="signupTitle">Signup</h1>

<div id="signup_con">
    <form id="frmSignup" action="api/signup.php" method="POST" onsubmit="return false">
        <input name="txtEmail" type="text" placeholder="Email">
        <input name="txtName" type="text" placeholder="Name">
        <input name="txtPassword" type="password" placeholder="Password">
        <button onclick="saveUser()">Sign up</button>
    </form>
</div>

<script>
    async function saveUser(){
        console.log('User saved');
        let oForm = document.querySelector('#frmSignup');
        let jResponse = await fetch('http://127.0.0.1/momondo-v11/apis/save-user.php', {
            "method": "POST",
            "body": new FormData(oForm)
        });
        let sData = await jResponse.text();
        console.log(sData);
    }
</script>

<?php
$sInjectJavascript = 'signup';
require_once('components/footer.php');
?>