<?php
// Assuming $createdAt is the timestamp of the creation time

// $time_elapsed = timeAgo($time_ago); 
//The argument $time_ago is in timestamp (Y-m-d H:i:s)format.

//Function definition
function timeAgo($time_ago)
{
    // $time_ago = strtotime($time_ago);
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed;
    $minutes    = round($time_elapsed / 60);
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400);
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640);
    $years      = round($time_elapsed / 31207680);
    // Seconds
    if ($seconds <= 60) {
        return "just now";
    }
    //Minutes
    else if ($minutes <= 60) {
        if ($minutes == 1) {
            return "Created at 1 minute ago";
        } else {
            return "Created at $minutes minutes ago";
        }
    }
    //Hours
    else if ($hours <= 24) {
        if ($hours == 1) {
            return "Created at an hour ago";
        } else {
            return "Created at $hours hrs ago";
        }
    }
    //Days
    else if ($days <= 7) {
        if ($days == 1) {
            return "Created at yesterday";
        } else {
            return "Created at $days days ago";
        }
    }
    //Weeks
    else if ($weeks <= 4.3) {
        if ($weeks == 1) {
            return "Created at a week ago";
        } else {
            return "Created at $weeks weeks ago";
        }
    }
    //Months
    else if ($months <= 12) {
        if ($months == 1) {
            return "Created at a month ago";
        } else {
            return "Created at $months months ago";
        }
    }
    //Years
    else {
        if ($years == 1) {
            return "Created at 1 year ago";
        } else {
            return "Created at $years years ago";
        }
    }
}


/**
 * @ Get total views
 */

function getViews($id)
{
    /**
     * Connection PostgreSQL
     */
    $host = "host = postgresql-154883-0.cloudclusters.net";
    $port = "port = 19815";
    $dbname = "dbname = marketplace";
    $credentials = "user = root password=E3kSs77s1Npem0bR";

    $db = pg_connect("$host $port $dbname $credentials");
    

    $sql = "SELECT total FROM views WHERE id = $id;";
    $result = pg_query($db, $sql);
    if ($result) {
        $row = pg_fetch_assoc($result);
        print_r($row['total']);
    }
}
