<?php 

if ( isset($_POST["from"])
&& isset($_POST["fromShortcut"])
&& isset($_POST["to"])
&& isset($_POST["toShortcut"])
&& isset($_POST["companyName"])
&& isset($_POST['companyShortcut'])
&& isset($_POST['departureTime']) 
&& isset($_POST['arrivalTime']) 
&& isset($_POST['price']) 
&& isset($_POST['currency'])
){
        
    // GET DATA

    $sData = file_get_contents('../data/flights.json');
    $jData = json_decode($sData);
    
    // Set checkbox to true or false

    if (empty($_POST['mostPopular'])){
        $_POST['mostPopular'] = false;
    }
    if(!empty($_POST['mostPopular'])){
        $_POST['mostPopular'] = true;
    }

    // CREATE FLIGHT

    $jFlight = new stdClass();
    $jFlight->id = bin2hex(random_bytes(16));
    $jFlight->flightId = $_POST['companyShortcut'].mt_rand(10,99);
    $jFlight->from = $_POST['from'];
    $jFlight->fromShortcut = $_POST['fromShortcut'];
    $jFlight->to = $_POST['to'];
    $jFlight->toShortcut = $_POST['toShortcut'];
    $jFlight->companyName = $_POST['companyName'];
    $jFlight->companyShortcut = $_POST['companyShortcut'];
    $jFlight->departureTime = (int)$_POST['departureTime'];
    $jFlight->arrivalTime = (int)$_POST['arrivalTime'];
    $jFlight->homeDate = $_POST['departureTime']+604800;
    $jFlight->price = (int)$_POST['price'];
    $jFlight->currency = $_POST['currency'];
    $jFlight->mostPopular = $_POST['mostPopular'];

    array_push($jData, $jFlight);

    $sData = json_encode($jData, JSON_PRETTY_PRINT);
    echo $sData;
    file_put_contents('../data/flights.json', $sData);
    header('Location: http://localhost/momondo-v1/admin.php');
}



?>
    <div id="list">
        <form id='frmCreateFlight' action='api-create-flight.php' method='POST'>
            <div>
                <label>Most popular</label>
                <input type='checkbox' name='mostPopular' value=true>
            </div>
            <div>
                <label>From</label>
                <input type='text' name='from'>
            </div>
            <div>
                <label>From abbr.</label>
                <input type='text' name='fromShortcut'>
            </div>
            <div>
                <label>To</label>
                <input type='text' name='to'>
            </div>
            <div>
                <label>To abbr.</label>
                <input type='text' name='toShortcut'>
            </div>
            <div>
                <label>Company name</label>
                <input type='text' name='companyName'>
            </div>
            <div>
                <label>Company abbr.</label>
                <input type='text' name='companyShortcut'>
            </div>
            <div>
                <label>Departure</label>
                <input type='text'name='departureTime'>
            </div>
            <div>
                <label>Arrival</label>
                <input type='text' name='arrivalTime'>
            </div>
            <div>
                <label>Price</label>
                <input type='text' name='price'>
            </div>
            <div>
                <label>Currency</label>
                <input type='text' name='currency'>
            </div>
            <div>
                <button id="save-button">CREATE FLIGHT</button>
            </div>
        </form>
    </div>

