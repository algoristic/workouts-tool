<?php
function getConnection() {
    $servername = 'db5000247540.hosting-data.io:3306';
    $username = 'dbu127642';
    $password = 'gam5M1ay>Fyj3BYnFyUN';
    $database = 'dbs241808';
    $connection = new mysqli($servername, $username, $password, $database);
    if ($connection->connect_error) {
        die("Connection failed: database unreachable");
    } else {
        return $connection;
    }
}
?>
