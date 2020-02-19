<?php 
require_once('has-access.php');
$sName = $_SESSION['sName'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
</head>
<body>
    <h1>Admin page</h1>
    <p>Hi, <?=$sName;?></p>
    <a href="logout.php">Logout</a>
</body>
</html>