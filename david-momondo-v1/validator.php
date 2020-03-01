<?php

function isStringValid($sFirstname, $iMin, $iMax) {
    if( strlen($sFirstname) < $iMin || strlen($sFirstname) > $iMax) {
        return false;
    }
    return true;
}
