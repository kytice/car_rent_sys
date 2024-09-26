<?php

function isValidRegNum($regNum) {
    $pattern = '/^2[1-4][1-2][A-Z]{1,2}\d{3,5}$/';
    if (!preg_match($pattern, $regNum)) {
        return false;
    }
    return true;
}
function isValidDriverLicense($driverLicense) {
    $pattern = '/^[A-Za-z0-9]{6,20}$/';
    if (!preg_match($pattern, $driverLicense)) {
        return false;
    }
    return true;
}
?>