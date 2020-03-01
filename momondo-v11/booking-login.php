<?php

if(isset($_POST['txtLastName']) && isset($_POST['txtBookingCode'])) {
    $sData = file_get_contents('booked-flights.json');
    $jData = json_decode($sData);
    $sUserLastName = $_POST['txtLastName'];
    $sUserBookingCode = $_POST['txtBookingCode'];
    foreach($jData as $jUser){ 
        if($jUser->userLastName == $sUserLastName && $jUser->bookingCode == $sUserBookingCode){
             session_start();
             $_SESSION['txtLastName'] = $sUserLastName;
             $_SESSION['txtBookingCode'] = $sUserBookingCode;
             header('Location: mytrips.php');
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
  <title>My Trips</title>
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
  <h1 id="bookingTitle">My trips</h1>
  <p id="booking-login-text">Use your last name and your booking code to login and view your trips. You can find your booking code from your email or recieved sms.</p>
    <div id="login_con">
        <form action="booking-login.php" method="POST">
            <input name="txtLastName" type="text" placeholder="Last name">
            <input name="txtBookingCode" type="password" placeholder="Booking code">
            <button>Login</button>
        </form> 
    </div>
<?php
$sInjectJavascript = 'booking-login';
require_once('components/footer.php');
?>