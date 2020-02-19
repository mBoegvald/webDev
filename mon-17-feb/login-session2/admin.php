<?php
require_once('has-access.php');
 $sName = $_SESSION['sName'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>

<h1>Hi, <?=$sName;?></h1>
    
    <a href="logout.php">Logout</a>
</body>
</html>