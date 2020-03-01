<?php
    if(isset($_POST['txtEmail']) && isset($_POST['txtPassword'])) 
    {
      // Connect to the database
      $sAdminCorrectEmail = 'a@a.com';
      $sAdminCorrectPassword = '12345';
      $sAdminEmail = $_POST['txtEmail'];
      $sAdminPassword = $_POST['txtPassword'];
      if( $sAdminCorrectEmail ==  $sAdminEmail &&
          $sAdminCorrectPassword == $sAdminPassword
      ){     
   
        // To start using sessions/cookies 
        session_start();
        // You can put anything in the sessions
        $_SESSION['sEmail'] = $sAdminEmail;
        header('Location: admin.php');
        exit();
      } else {
        echo "<script>alert('You are not an admin');</script>";
      }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="app.css">
    <title>Login</title>
</head>
<body>
<?php
  require_once('nav.php');
  ?>

<section id="login">
<h1>Admin login</h1>
  <form  action="login.php" method="POST" onsubmit="return validate()">
    <input oninput="validate()" name="txtEmail" type="text" placeholder="Email" data-validate="email">
    <input oninput="validate()" name="txtPassword" type="text" placeholder="Password" data-validate="string" data-min="5" data-max="20">
    <button>LOGIN</button>
  </form>
</section>

<script src="app.js"></script>
</body>
</html>