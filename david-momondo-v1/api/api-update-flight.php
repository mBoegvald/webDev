<?php
  // User wants to update the data
  if( 
    isset($_POST['flight-id']) &&  
    isset($_POST['from-city'])
  ){
    // Open file
    $sData = file_get_contents('../data.json');
    // Convert text file to JSON
    $jData = json_decode($sData);

    
    // Loop and find a match
    foreach($jData as $jFlight){
        foreach($jFlight->schedule as $jEditFlight) { 

        if($jFlight->id == $_POST['flight-id']){
  
        // Update the city name in the match / break
        $jEditFlight->from = $_POST['from-city'];
        $jEditFlight->fromShortcut = $_POST['from-city-shortcut'];
        $jEditFlight->to = $_POST['to-city'];
        $jEditFlight->toShortcut = $_POST['to-city-shortcut'];
        $jEditFlight->companyName = $_POST['company-name'];
        $jEditFlight->companyShortcut = $_POST['company-shortcut'];
        $jEditFlight->departureTime = (int)$_POST['departure-date'];
        $jEditFlight->arrivalTime = (int)$_POST['arrival-date'];
        $jEditFlight->totalTime = (int)$_POST['flight-time'];
        $jFlight->price = (int)$_POST['price'];
        
        break;
        }
      }
    }

    $sData = json_encode($jData, JSON_PRETTY_PRINT);
    file_put_contents('../data.json', $sData);
    // Redirect user to cities.php
    header('Location: ../admin.php');
    exit();
  }
  
  
  if(  isset($_GET['id'])   ){
      $sFlightId = $_GET['id'];
      // Open file
      $sData = file_get_contents('../data.json');
      // Convert text to JSON
      $jData = json_decode($sData);
 ?>
    
        <!DOCTYPE html>
        <html lang="en">
        <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <meta http-equiv="X-UA-Compatible" content="ie=edge">
          <link rel="stylesheet" href="../app.css">
          <title>UPDATE CITY</title>
        </head>
        <body>
 <?php
    require_once('../nav.php');
    $bFlightFound = false;
    foreach($jData as $jFlight){
        foreach($jFlight->schedule as $jEditFlight) {
        if($sFlightId == $jFlight->id) {
        ?>
          <form action="api-update-flight.php" method="POST">
            <input name="flight-id" type="hidden" value="<?= $jFlight->id ?>">
            <input name="from-city" type="text" placeholder="From city" value="<?= $jEditFlight->from; ?>">
            <input name="from-city-shortcut" type="text" placeholder="From city shortcut" value="<?= $jEditFlight->fromShortcut; ?>">
            <input name="to-city" type="text" placeholder="To city" value="<?= $jEditFlight->to; ?>">
            <input name="to-city-shortcut" type="text" placeholder="To city shortcut" value="<?= $jEditFlight->toShortcut; ?>">
            <input name="company-name" type="text" placeholder="Company name" value="<?= $jEditFlight->companyName; ?>">
            <input name="company-shortcut" type="text" placeholder="company shortcut" value="<?= $jEditFlight->companyShortcut; ?>">
            <input name="departure-date" type="text" placeholder="Departure date" value="<?= $jEditFlight->departureTime; ?>">
            <input name="arrival-date" type="text" placeholder="Arrival date" value="<?= $jEditFlight->arrivalTime; ?>">
            <input name="flight-time" type="text" placeholder="Total flight time" value="<?= $jEditFlight->totalTime; ?>">
            <input name="price" type="text" placeholder="price" value="<?= $jFlight->price; ?>">
            <button name="<?= $jEditFlight->FlightId; ?>" id="" type="submit">UPDATE</button>
          </form>
          <?php
        $bCityFound = true;
    break;
}
}
}

if($bCityFound == false){
    header('Location: ../admin.php');
}
}
?>
</body>
</html> 
