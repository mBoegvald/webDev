<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User</title>
</head>
<body>
    <nav>
        <a href="cities.php">Cities</a>
        <a href="users.php">Users</a>
    </nav>
    <form action="save-user.php" method="POST">
        <input name="user-name" type="text" placeholder="Name">
        <input name="user-age" type="text" placeholder="Age">
        <button type="submit">SAVE</button>
    </form>

    <?php 

    $sData = file_get_contents("data.json");

    $jData = json_decode($sData);
    
    foreach($jData->users as $user) {
    echo "<p>$user->name
            <a href='delete-user.php?id=$user->id'>Delete user</a>
            <a href='update-user.php?id=$user->id'>Edit user</a>
        </p>";
    }
?>


</body>
</html>
<?php 
