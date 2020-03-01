<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="app.css">
    <title>Add flight</title>
</head>
<body>
    <?php
        require_once('nav.php');
    ?>
    <section id="addFlight">
    <form onsubmit="return validate()" action="api/api-save-flight.php" method="POST">
        <input type="text" name="flight-id" placeholder="Flight id">
        <input oninput="validate()" name="from-city" type="text" placeholder="From city" data-validate="string" data-min="1" data-max="99">
        <input oninput="validate()" name="from-city-shortcut" type="text" placeholder="From city shortcut" data-validate="string" data-min="1" data-max="99">
        <input oninput="validate()" name="to-city" type="text" placeholder="To city"  data-validate="string" data-min="1" data-max="99">
        <input oninput="validate()" name="to-city-shortcut" type="text" placeholder="To city shortcut"  data-validate="string" data-min="1" data-max="99">
        <input oninput="validate()" name="company-name" type="text" placeholder="Company name"  data-validate="string" data-min="1" data-max="99">
        <input oninput="validate()" name="company-shortcut" type="text" placeholder="company shortcut"  data-validate="string" data-min="1" data-max="99">
        <input oninput="validate()" name="departure-date" type="text" placeholder="Departure date" data-validate="integer" data-min="1000000000" data-max="9999999999">
        <input name="arrival-date" type="text" placeholder="Arrival date">
        <input oninput="validate()" name="flight-time" type="text" placeholder="Total flight time" data-validate="integer" data-min="1" data-max="99999">
        <input oninput="validate()" name="price" type="text" placeholder="price" data-validate="integer" data-min="1" data-max="9999999999">
        <input oninput="validate()" name="currency" type="text" placeholder="Currency" data-validate="string" data-min="1" data-max="999">
        <label>Make flight a popular flight</label>
        <input name="popular-flight" type="checkbox">
        <button>Add flight</button>
    </form>
</section>
<script src="app.js"></script>
</body>
</html>