<?php 
$jName = $_POST['name'];
$jPerson = new stdClass();
$jPerson->name = $jName;

$sPerson = json_encode($jPerson);

file_put_contents("data.json", $sPerson);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="post.php" method="POST">
        <input type="text" name="name">
        <button>SUBMIT NAME</button>
    </form>
    
</body>
</html>