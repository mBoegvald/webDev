<?php
$errorMessage = '';
if(isset($_POST['txtUsername']) && isset($_POST['txtPassword'])){
  
  $_POST['frmAdminLogin'] = $_POST['frmAdminLogin'] ?? false;
  $_POST['frmCustomerLogin'] = $_POST['frmCustomerLogin'] ?? false;
  // CHECK IF ADMIN LOGIN OR USER LOGIN 
  if($_POST['frmAdminLogin']) {
    $username = 'admin';
    $password = 'admin';
    $name = 'Miklas Bøgvald';
    $admin = true;
    if($username == $_POST['txtUsername'] && $password == $_POST['txtPassword']){
      session_start();
      $_SESSION['sName'] = $name;
      $_SESSION['bAdmin'] = $admin;
      header('Location: admin.php');
      exit();
    }
  }
  if($_POST['frmCustomerLogin']) {

    // Get array of users
    $sUsers = file_get_contents('http://localhost/momondo-v1/data/bookings.json');
    $jUsers = json_decode($sUsers);

    // Loop through array
    foreach($jUsers->users as $jUser){
      // Make sure lastname is lowercase
      $jUser->userLastname = mb_strtolower($jUser->userLastname,'UTF-8');
      $_POST['txtUsername'] = mb_strtolower($_POST['txtUsername'],'UTF-8');
      $admin = false;

      if($jUser->userLastname == $_POST['txtUsername'] && $jUser->bookingId == $_POST['txtPassword']){
        session_start();
        $_SESSION['sName'] = ucfirst($jUser->userFirstname).' '.ucfirst($jUser->userLastname);
        $_SESSION['bAdmin'] = $admin;
        header('Location: customer.php');
        exit();
      }
    }
  }
  $errorMessage = "Wrong username or password";
}
  require_once('top.php');
?>
  
    <section id="login">
      <h1 id="errorMessage"><?=$errorMessage?></h1>
      <form id="frmAdminLogin" action="login.php" method="POST">
      <input type="hidden" name="frmAdminLogin" value="true">
        <h1>Admin login</h1>
        <input type="text" name="txtUsername" placeholder="Username"/>
        <input type="text" name="txtPassword" placeholder="Password" />
        <button>Login</button>
      </form>
      <form id="frmCustomerLogin" action="login.php" method="POST">
      <input type="hidden" name="frmCustomerLogin" value="true">
        <h1>Customer login</h1>
        <input type="text" name="txtUsername" placeholder="Lastname"/>
        <input type="text" name="txtPassword" placeholder="Booking ID" />
        <button>Login</button>
      </form>
    </section>
  </body>
</html>
