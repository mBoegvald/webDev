<?php 
function isStringValid($sText, $iMin, $iMax){
    if( strlen($sText) < $iMin || strlen($sText) > $iMax ) {
        return false;
    }
    return true;
}

function isIntegerValid($iInteger, $iMin, $iMax) {
    if ( !ctype_digit($iInteger)) {
        return false;
    }
    if ( $iInteger < $iMin || $iInteger > $iMax) {
        return false;
    }
    return true;
}