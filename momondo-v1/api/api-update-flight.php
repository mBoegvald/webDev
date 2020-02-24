<?php 
if(isset($_POST["companyName"]) && isset($_POST['companyShortcut'])
&& isset($_POST['departureTime']) && isset($_POST['arrivalTime']) 
&& isset($_POST['price']) && isset($_POST['currency'])) {
    $sData = file_get_contents('../data/most-popular-flights.json');
    $jData = json_decode($sData);   

    foreach($jData as $jFlight){
        if($jFlight->id == $_POST['id']){
            $jFlight->companyName = $_POST['companyName'];
            $jFlight->companyShortcut = $_POST['companyShortcut'];
            $jFlight->departureTime = $_POST['departureTime'];
            $jFlight->arrivalTime = $_POST['arrivalTime'];
            $jFlight->price = $_POST['price'];
            $jFlight->currency = $_POST['currency'];
            break;
        }
    }
    $sData = json_encode($jData, JSON_PRETTY_PRINT);
    file_put_contents('../data/most-popular-flights.json', $sData);
    echo $sData;
    header("Location: http://localhost/momondo-v1/admin.php");
    exit;
}

if(isset($_GET['id'])){
    
    $sFlightId = $_GET['id'];
    $sData = file_get_contents("../data/most-popular-flights.json");
    $jData = json_decode($sData);
    $bMatchFound = false;
    foreach($jData as $jFlight) {
        if($jFlight->id == $sFlightId){
            
            require_once('../top.php');
            ?>
            <div id="list">
                <form id='frmUpdateFlight' action='api-update-flight.php' method='POST'>
                    <div>
                        <input type="hidden" name='id' value='<?=$jFlight->id?>'></input>
                    </div>
                    <div>
                        <label>Company name</label>
                        <input type='text' name='companyName' value='<?=$jFlight->companyName?>'>
                    </div>
                    <div>
                        <label>Company abbreviation</label>
                        <input type='text' name='companyShortcut' value='<?=$jFlight->companyShortcut?>'>
                    </div>
                    <div>
                        <label>Time of departure</label>
                        <input type='text'name='departureTime' value='<?=$jFlight->departureTime?>'>
                    </div>
                    <div>
                        <label>Time of arrival</label>
                        <input type='text' name='arrivalTime' value='<?=$jFlight->arrivalTime?>'>
                    </div>
                    <div>
                        <label>Price</label>
                        <input type='text' name='price' value='<?=$jFlight->price?>'>
                    </div>
                    <div>
                        <label>Currency</label>
                        <input type='text' name='currency' value='<?=$jFlight->currency?>'>
                    </div>
                    <div>
                        <button>UPDATE</button>
                    </div>
                </form>
            </div>
            </body>
            </html>
            <?php
            $bMatchFound = true;
            break;

        }
    }
    if($bMatchFound == false) {
        header("Location: http://localhost/momondo-v1/admin.php");
        exit;
    }
}

