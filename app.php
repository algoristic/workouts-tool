<?php
include 'database.php';
function main() {
    $db = getConnection();
    echo '<div id="wrapper">';
    $sql = 'SELECT name, type, done FROM workouts';
    $result = $db->query($sql);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo 'name: ' . $row['name'] . '<br>';
        }
    }
    echo '</div>';
}
?>
