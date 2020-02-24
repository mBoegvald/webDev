<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CITY ADMIN</title>
</head>
<body>
    <nav>
        <a href="cities.php">Cities</a>
        <a href="users.php">Users</a>
    </nav>
    <form action="save-city.php" method="POST">
        <input name="city-name" type="text" placeholder="Name">
        <input name="city-abbr" type="text" placeholder="Abbreviation">
        <input name="city-lng" type="text" placeholder="Longtitude">
        <input name="city-lat" type="text" placeholder="Latitude">
        <button type="submit">SAVE</button>
    </form>

    <?php 

    $sData = file_get_contents("data.json");

    $jData = json_decode($sData);
    
    foreach($jData->cities as $city) {
    echo "<p>$city->name
            <a href='delete-city.php?id=$city->id'>Delete city</a>
            <a href='update-city.php?id=$city->id'>Edit city</a>
        </p>";
    }
?>


</body>
</html>
<?php 
