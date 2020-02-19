<?php

    $username = 'admin';
    $password = 'admin';
    $name = 'Miklas';
    if(isset($_POST['txtUsername']) && isset($_POST['txtPassword'])){
        
        // $sData = file_get_contents('data.json');
        // $jData = json_decode($sData);

        // foreach($jData->users as $jUser){
            if($username == $_POST['txtUsername'] && $password == $_POST['txtPassword']){
                session_start();
                $_SESSION['sName'] = $name;
                header('Location: admin.php');
                exit();
            }
        // }
        echo "Wrong email or password";
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
  </head>
  <body>
    <form action="login.php" method="POST">
      <input type="text" name="txtUsername" />
      <input type="text" name="txtPassword" />
      <button>Login</button>
    </form>
  </body>
</html>
