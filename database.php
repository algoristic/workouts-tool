<?php
function getConnection() {
    $servername = 'db5000247540.hosting-data.io:3306';
    $username = 'dbu127642';
    $password = '_4Wm]8keX1K_hC(7V((M';
    $database = 'dbs241808';
    $connection = new mysqli($servername, $username, $password, $database);
    if ($connection->connect_error) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        return $connection;
    }
}

function query($sql) {
    $connection = getConnection();
    try {
        return $connection->query($sql);
    } finally {
        $connection->close();
    }
}

function createWorkout($name, $ui_name, $focus_id, $type_id, $difficulty_id) {
    $select_query = 'SELECT id FROM workouts WHERE name = "' . $name . '"';
    $insert_query  = 'INSERT INTO workouts (name, ui_name, focus_id, type_id, difficulty_id) VALUES ("' . $name . '", "' . $ui_name . '", "' . $focus_id . '", "' . $type_id . '", "' . $difficulty_id . '")';
    return getIdOrCreateNew($select_query, $insert_query);
}

function fetchDifficulty($value, $ui_value) {
    $select_query = 'SELECT id FROM diffculties WHERE value = "' . $value . '"';
    $insert_query  = 'INSERT INTO diffculties (value, ui_value) VALUES ("' . $value . '", "' . $ui_value . '")';
    return getIdOrCreateNew($select_query, $insert_query);
}

function fetchFocus($value, $ui_value) {
    $select_query = 'SELECT id FROM focuses WHERE value = "' . $value . '"';
    $insert_query  = 'INSERT INTO focuses (value, ui_value) VALUES ("' . $value . '", "' . $ui_value . '")';
    return getIdOrCreateNew($select_query, $insert_query);
}

function fetchType($value, $ui_value) {
    $select_query = 'SELECT id FROM types WHERE value = "' . $value . '"';
    $insert_query  = 'INSERT INTO types (value, ui_value) VALUES ("' . $value . '", "' . $ui_value . '")';
    return getIdOrCreateNew($select_query, $insert_query);
}

function getIdOrCreateNew($select_query, $insert_query) {
    $result = query($select_query);
    if($result->num_rows > 0) {
        return $result->fetch_assoc()['id'];
    } else {
        query($insert_query);
        return getIdOrCreateNew($select_query, $insert_query);
    }
}
?>
