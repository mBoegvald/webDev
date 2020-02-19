<?php
    require_once('has-access.php');
    $sUserEmail = $_SESSION['sEmail'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
    <h1>ADMIN</h1>
    <h2>Hi, <?=$sUserEmail;?></h2>
    <a href="logout.php">Logout</a>
    <a href="add-flight.php">Add flight</a>
    <a href="users.php">Users</a>
</body>
</html>