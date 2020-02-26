<?php
require_once('validate.php');
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
    
    $sData = file_get_contents('../data/flights.json');
    $jData = json_decode($sData);   

    foreach($jData as $jFlight){
        if($jFlight->id == $_POST['id']){
            if (empty($_POST['mostPopular'])){
                $_POST['mostPopular'] = false;
            }
            if(!empty($_POST['mostPopular'])){
                $_POST['mostPopular'] = true;
            }
            $jFlight->mostPopular = $_POST['mostPopular'];
            $jFlight->from = $_POST['from'];
            $jFlight->fromShortcut = $_POST['fromShortcut'];
            $jFlight->to = $_POST['to'];
            $jFlight->toShortcut = $_POST['toShortcut'];
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
    file_put_contents('../data/flights.json', $sData);
    echo $sData;
    header("Location: http://localhost/momondo-v1/admin.php");
    exit;
}

if(isset($_GET['id'])){
    
    $sFlightId = $_GET['id'];
    $sData = file_get_contents("../data/flights.json");
    $jData = json_decode($sData);
    $bMatchFound = false;
    foreach($jData as $jFlight) {
        if($jFlight->id == $sFlightId){
            if($jFlight->mostPopular) {
                $checked = 'checked';
            }
            if(!$jFlight->mostPopular){
                $checked = '';
            }   
            require_once('../top.php');
            ?>
            <div id="list">
                <form id='frmUpdateFlight' action='api-update-flight.php' method='POST'>
                    <div>
                        <input type="hidden" name='id' value='<?=$jFlight->id?>'></input>
                    </div>
                    <div>
                        <label>Most popular</label>
                        <input type='checkbox' name='mostPopular' value=true <?=$checked?>>
                    </div>
                    <div>
                        <label>From</label>
                        <input type='text' name='from' value='<?=$jFlight->from?>'>
                    </div>
                    <div>
                        <label>From abbr.</label>
                        <input type='text' name='fromShortcut' value='<?=$jFlight->fromShortcut?>'>
                    </div>
                    <div>
                        <label>To</label>
                        <input type='text' name='to' value='<?=$jFlight->to?>'>
                    </div>
                    <div>
                        <label>To abbr.</label>
                        <input type='text' name='toShortcut' value='<?=$jFlight->toShortcut?>'>
                    </div>
                    <div>
                        <label>Company name</label>
                        <input type='text' name='companyName' value='<?=$jFlight->companyName?>'>
                    </div>
                    <div>
                        <label>Company abbr.</label>
                        <input type='text' name='companyShortcut' value='<?=$jFlight->companyShortcut?>'>
                    </div>
                    <div>
                        <label>Departure</label>
                        <input type='text'name='departureTime' value='<?=$jFlight->departureTime?>'>
                    </div>
                    <div>
                        <label>Arrival</label>
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
                        <button id="save-button">UPDATE</button>
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

