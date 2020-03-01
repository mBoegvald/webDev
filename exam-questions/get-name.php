<?php
// $sData = file_get_contents("data.json");
// $jData = json_decode($sData);

// $jPerson = new stdClass();
// $jPerson->name = $_POST['name'];

$jName = $_POST['name'];
// array_push($jData, $jPerson);

$sName = json_encode($jName);

// $sData = json_encode($jData, JSON_PRETTY_PRINT);
// echo $sData;
// $sPerson = json_encode($jPerson, JSON_PRETTY_PRINT);
// file_put_contents("data.json", $jPerson);

echo $sName;
file_put_contents("data.json", $sName);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="get-name.php" method="POST">
        <input type="text" name="name">
        <button type="submit">Submit</button>
    </form>
</body>
</html>




