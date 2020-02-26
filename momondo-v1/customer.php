<?php 
require_once('has-access.php');
$sLastname = $_SESSION['sLastname'];
$sBookingId = $_SESSION['bookingId'];
$sData = file_get_contents('http://localhost/momondo-v1/data/bookings.json');
$jData = json_decode($sData);
$sBookingDiv = '';

foreach($jData->users as $jFlight) {
    if($sBookingId == $jFlight->bookingId && $sLastname == mb_strtolower($jFlight->userLastname)) {
        $from = $jFlight->bookings->from;
        $to = $jFlight->bookings->to;
        $companyName = $jFlight->bookings->companyName;
        $departureTime = date("d-M-Y H:i", substr($jFlight->bookings->departureTime, 0, 10));
        $arrivalTime = date("d-M-Y H:i", substr($jFlight->bookings->arrivalTime, 0, 10));
        $price = $jFlight->bookings->price/100;

        $sBookingDiv .= "
            <div id='booking-div'>
                <div>
                    <h2>Personal information</h2>
                    <p>Firstname: $jFlight->userFirstname</p>
                    <p>Lastname: $jFlight->userLastname</p>
                    <p>Email: $jFlight->userEmail</p>
                </div>
                <div>
                    <h2>Booking information</h2>
                    <p>From: $from</p>
                    <p>To: $to</p>
                    <p>Company name: $companyName</p>
                    <p>Time of departure: $departureTime</p>
                    <p>Time of arrival: $arrivalTime</p>
                    <p>Price: $price kr.</p>
                    
                </div>
            </div>
           
        ";
    }
}
require_once('top.php');
?>
    <div id="admin">
        <h1>Customer page</h1>
    </div>
    <div id="list">
        <?= $sBookingDiv ?>
    </div>
</body>
</html>