<?php
function getConnection() {
    $servername = 'db5000247540.hosting-data.io:3306';
    $username = 'dbu127642';
    $password = '_4Wm]8keX1K_hC(7V((M';
    $database = 'dbs241808';
    $connection = new mysqli($servername, $username, $password, $database);
    if ($connection->connect_error) {
        die("Connection failed: database unreachable");
    } else {
        return $connection;
    }
}

//$db = getConnection();
//echo '<div id="wrapper">';
//$sql = 'SELECT name, type, done FROM workouts';
//$result = $db->query($sql);
//if($result->num_rows > 0) {
//    while($row = $result->fetch_assoc()) {
//        echo 'name: ' . $row['name'] . '<br>';
//    }
//}
?>
