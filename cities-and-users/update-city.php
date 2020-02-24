<?php 

if(isset($_POST["txtCityId"]) && isset($_POST['txtCityName'])) {

    // Open file
    $sData = file_get_contents("data.json");

    //Convert file to JSON
    $jData = json_decode($sData);

    $sCityId = $_POST['txtCityId'];
    $sCityName = $_POST['txtCityName'];

    // Loop and find a match
    foreach($jData->cities as $jCity) {
        if($jCity->id == $sCityId){

            // Update the city name and break
            $jCity->name = $sCityName;
            break;
        }
    }

    // Convert JSON to text and save it 
    $sData = json_encode($jData, JSON_PRETTY_PRINT);
    file_put_contents('data.json', $sData);

    // Redirect
    header("Location: cities.php");
    exit;
}

if(isset($_GET['id'])){
    $sCityId = $_GET['id'];
    $sData = file_get_contents("data.json");
    $jData = json_decode($sData);
    $bMatchFound = false;
    foreach($jData->cities as $jCity) {
        if($jCity->id == $sCityId){
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <title>Update-city</title>
            </head>
            <body>
                <form action="update-city.php" method="POST">
                    <input name="txtCityId" type="hidden" value="<?= $jCity->id; ?>">
                    <input name="txtCityName" type="text" value="<?= $jCity->name; ?>"></input>
                    <button>UPDATE</button>
                </form>
            </body>
            </html>
            <?php
            $bMatchFound = true;
            break;

        }
    }
    if($bMatchFound == false) {
        header("Location: cities.php");
        exit;
    }
}

