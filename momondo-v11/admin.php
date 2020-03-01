<?php
    session_start();
    if(!isset($_SESSION['sEmail'])) {
        header('Location: login.php');
        exit();
    }
    $UserEmail = $_SESSION['sEmail'];

    $sFlights = file_get_contents('most-popular-flights.json');
    $jFlights = json_decode($sFlights);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="styles/app.css">
  <title>Admin</title>
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
    <h1 id="adminTitle">Hi, <?= $UserEmail ?></h1>

<div id="adminSection">
  <div id="adminFormContainer">
    <h2>Create flight</h2>
    <form id="adminForm" action="apis/api-save-flight.php" method="POST">
        <label for="flight-id">Enter flight id</label>
        <input name="flight-id" type="text" placeholder="Ex. KLM99">
        <label for="flight-name">Enter company name</label>
        <input name="flight-name" type="text" placeholder="Ex. Air France">
        <label for="flight-shortcut">Enter flight shortcut</label>
        <input name="flight-shortcut" type="text" placeholder="Ex. AF">
        <label for="departure-time">Enter departure time</label>
        <input name="departure-time" type="text" placeholder="Ex. 01-01-1900 12:00">
        <label for="arrival-time">Enter arrival time</label>
        <input name="arrival-time" type="text" placeholder="Ex. 01-01-1900 12:00">
        <label for="total-time">Enter total time in min.</label>
        <input name="total-time" type="text" placeholder="Ex. 180">
        <label for="price">Enter price</label>
        <input name="price" type="text" placeholder="Ex. 1250">
        <label for="flight-from">Enter from city</label>
        <input name="flight-from" type="text" placeholder="Ex. Berlin">
        <label for="flight-to">Enter to city</label>
        <input name="flight-to" type="text" placeholder="Ex. Copenhagen">
        <label for="flight-to">Enter pilots name</label>
        <input name="flight-pilot" type="text" placeholder="Ex. John doe">
        <button type="submit">SAVE</button>
    </form>
  </div>
      <div id="flightItemsContainer">
        <h2>Update flights</h2>
        <?php
            foreach($jFlights as $flight){
                echo "<div class='flightItem'>
                        $flight->from - $flight->to
                        <div class='flightButtonsCon'>
                          <a class='delete' href='apis/api-delete-flight.php?id=$flight->id'>Delete</a>
                          <a href='apis/api-update-flight.php?id=$flight->id'>Update</a>
                        </div>
                      </div>
                    ";
                    // In a tag added variable with id of city
            }
        ?>
      </div>
</div>
<div id="logoutLink">
<a href="logout.php">Logout</a>
</div>
<?php
$sInjectJavascript = 'admin';
require_once('components/footer.php');
?>