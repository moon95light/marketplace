<?php
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
