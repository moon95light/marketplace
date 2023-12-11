<?php


echo timeFormat(1000);

function timeFormat($duration) {
    $formattedDuration = gmdate('H:i:s', $duration);
    $hour = substr($formattedDuration, 0, 3);
    if($hour == "00:") {
        $formattedDuration = substr($formattedDuration, 3);
    }
    return $formattedDuration;
}