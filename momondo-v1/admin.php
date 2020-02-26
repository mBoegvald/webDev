<?php 
require_once('has-access.php');
$sName = $_SESSION['sName'];

$sData = file_get_contents('http://localhost/momondo-v1/data/flights.json');
$jData = json_decode($sData);
$sFlightDiv = '';

foreach($jData as $jFlight) {
    if ($jFlight->mostPopular) {
        $checked = 'checked';
    }
    if(!$jFlight->mostPopular) {
        $checked = '';
    }

    $sFlightDiv .= "
        <form id='frmFlightList' onsubmit='return false'>
            <input type='hidden' name='id' value='$jFlight->id'>
            <div>
                <label>Most popular</label>
                <input type='checkbox' name='mostPopular' value=true $checked disabled>
            </div>
            <div>
                <label>From</label>
                <input type='text' name='from' value='$jFlight->from' readonly>
            </div>
            <div>
                <label>From abbr.</label>
                <input type='text' name='fromShortcut' value='$jFlight->fromShortcut'readonly>
            </div>
            <div>
                <label>To</label>
                <input type='text' name='to' value='$jFlight->to'readonly>
            </div>
            <div>
                <label>To abbr.</label>
                <input type='text' name='toShortcut' value='$jFlight->toShortcut'readonly>
            </div>
            <div>
                <label>Company name</label>
                <input type='text' name='companyName' value='$jFlight->companyName'readonly>
            </div>
            <div>
                <label>Company abbr.</label>
                <input type='text' name='companyShortcut' value='$jFlight->companyShortcut'readonly>
            </div>
            <div>
                <label>Departure</label>
                <input type='text'name='departureTime' value='$jFlight->departureTime'readonly>
            </div>
            <div>
                <label>Arrival</label>
                <input type='text' name='arrivalTime' value='$jFlight->arrivalTime'readonly>
            </div>
            <div>
                <label>Price</label>
                <input type='text' name='price' value='$jFlight->price'readonly>
            </div>
            <div>
                <label>Currency</label>
                <input type='text' name='currency' value='$jFlight->currency'readonly>
            </div>
            <div id='div-save-button'>
                <a href='http://localhost/momondo-v1/api/api-update-flight.php?id=$jFlight->id' type='button' id='save-button''>EDIT</a>
            </div>
            <div id='div-delete-button'>
                <a href='http://localhost/momondo-v1/api/api-delete-flight.php?id=$jFlight->id' type='button' id='delete-button'>&#x2716;</a>
            </div>
            
        </form>
    ";
}

require_once('top.php');

?>
    <div id="admin">
        <h1>Admin page</h1>
        <p>Hi, <?=$sName;?></p>
    </div>
    <div id="list">
        <?= $sFlightDiv ?>
    </div>
<script src="app.js"></script>
</body>
</html>