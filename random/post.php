<?php 
    $jName = $_POST['name'];
    $sName = json_encode($jName);
    file_put_contents("data.json",$sName);
    echo $sName;
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
    <button type="submit">Submit</button>
</form>
 
</body>
</html>