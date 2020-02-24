<select>
<option>From</option>
<?php 

$saLetters = file_get_contents("cities.txt");

$aLetters = json_decode($saLetters);
foreach($aLetters[0] as $letter) {
    echo "<option>$letter</option>";
}
?>

</select>
<select>
<option>To</option>
<?php 
foreach($aLetters[1] as $letter) {
    echo "<option>$letter</option>";
}
?>

</select>
