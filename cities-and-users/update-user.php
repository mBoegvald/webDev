<?php 

if(isset($_POST["txtUserId"]) && isset($_POST['txtUserName'])) {

    // Open file
    $sData = file_get_contents("data.json");

    //Convert file to JSON
    $jData = json_decode($sData);

    $sUserId = $_POST['txtUserId'];
    $sUserName = $_POST['txtUserName'];

    // Loop and find a match
    foreach($jData->users as $jUser) {
        if($jUser->id == $sUserId){

            // Update the city name and break
            $jUser->name = $sUserName;
            break;
        }
    }

    // Convert JSON to text and save it 
    $sData = json_encode($jData, JSON_PRETTY_PRINT);
    file_put_contents('data.json', $sData);

    // Redirect
    header("Location: users.php");
    exit;
}

if(isset($_GET['id'])){
    $sUserId = $_GET['id'];
    $sData = file_get_contents("data.json");
    $jData = json_decode($sData);
    $bMatchFound = false;
    foreach($jData->users as $jUser) {
        if($jUser->id == $sUserId){
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <title>Update-user</title>
            </head>
            <body>
                <form action="update-user.php" method="POST">
                    <input name="txtUserId" type="hidden" value="<?= $jUser->id; ?>">
                    <input name="txtUserName" type="text" value="<?= $jUser->name; ?>"></input>
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
        header("Location: users.php");
        exit;
    }
}

