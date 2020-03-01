<?php
$sKey = $_GET['key'];
// Connect to the user database
$sData = file_get_contents('../user.json');
$jData = json_decode($sData);
// Check if the key matches
// If so, flip the verified to 1
foreach($jData->users as $jUser){
    if($sKey == $jUser->key){
        $jUser->verified = 1;
        $sData = json_encode($jData, JSON_PRETTY_PRINT);
        file_put_contents('../user.json', $sData);
        $message = 'Now you can login <a href="http://127.0.0.1/momondo-v11/login.php">Click here to login</a>';
        echo $message;
        exit();
    }
}
// else show error message 
echo 'ERROR - CANNOT VERIFY';