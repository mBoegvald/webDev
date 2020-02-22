<?php 
require_once('has-access.php');
$sName = $_SESSION['sName'];

$sData = file_get_contents('http://localhost/momondo-v1/data/most-popular-flights.json');
$jData = json_decode($sData);
$sFlightDiv = '';

foreach($jData as $jFlight) {

    $sFlightDiv .= "
        <form id='frmFlightList' onsubmit='return false'>
            <input type='hidden' name='id' value='$jFlight->id'>
            <div>
                <label>Company name</label>
                <input type='text' name='companyName' value='$jFlight->companyName'>
            </div>
            <div>
                <label>Company abbreviation</label>
                <input type='text' name='companyShortcut' value='$jFlight->companyShortcut'>
            </div>
            <div>
                <label>Time of departure</label>
                <input type='text'name='departureTime' value='$jFlight->departureTime'>
            </div>
            <div>
                <label>Time of arrival</label>
                <input type='text' name='arrivalTime' value='$jFlight->arrivalTime'>
            </div>
            <div>
                <label>Price</label>
                <input type='text' name='price' value='$jFlight->price'>
            </div>
            <div>
                <label>Currency</label>
                <input type='text' name='currency' value='$jFlight->currency'>
            </div>
            <div>
                <button type='button' id='save-button' onclick='saveFlight()'>SAVE</button>
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