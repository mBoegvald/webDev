<?php
    // Check if inputs exist
    if(isset($_POST['txtFlightId']) && isset($_POST['txtFlightFrom'])){
      echo 'User trying to update data..';
      // Open file
      $sData = file_get_contents('../most-popular-flights.json');
      //Convert text file to json
      $jData = json_decode($sData);
      // Loop and find a match
      foreach($jData as $jFlight){
        if($jFlight->id == $_POST['txtFlightId']){
            echo "Match found";
            // Update the flight name in the match / break
            $jFlight->from = $_POST['txtFlightFrom'];
            echo $jFlight->from;
            $jFlight->to = $_POST['txtFlightTo'];
            echo $jFlight->to;
        break;
        }
      }
      // Convert Json to text and save it
      $sData = json_encode($jData, JSON_PRETTY_PRINT);
      file_put_contents('../most-popular-flights.json', $sData);
      // Redirect user to admin.php
      header('location: ../admin.php');
      exit();
    }

    // Checks if id in url - isset is a function
    if(isset($_GET['id'])){
        $sFlightId = $_GET['id'];
        // Open file
        $sData = file_get_contents('../most-popular-flights.json');
        // Convert text data to object
        $jData = json_decode($sData);
        $aflight = $jData;
        // Declare variable to check if id is found
        $bFlightFound = false;
        // Loop through each flight
        foreach($aflight as $jFlight){
            if($sFlightId == $jFlight->id){
                // Flip variable to true if flight found
                $bFlightFound = true;
                ?> 
                       <!DOCTYPE html>
                        <html lang="en">
                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <meta http-equiv="X-UA-Compatible" content="ie=edge">
                            <link rel="stylesheet" href="../styles/app.css">
                            <title>Update flight</title>
                        </head>
                        <body>
                            <h1 id="updateTitle">Update Flight</h1>
                            <form id="updateForm" action="api-update-flight.php" method="POST">
                                <input name="txtFlightId" type="hidden" value="<?= $jFlight->id; ?>">
                                <input name="txtFlightFrom" type="text" value="<?= $jFlight->from; ?>">
                                <input name="txtFlightTo" type="text" value="<?= $jFlight->to; ?>">
                                <button type="submit">UPDATE</button>
                            </form>
                        </body>
                        </html>
                <?php   
                break;
            }
        }
        if($bFlightFound == false) {
            header('location: ../admin.php');
        }
    }
?>
