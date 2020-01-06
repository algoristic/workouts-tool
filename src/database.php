<?php
function getConnection() {
    $servername = 'db5000247540.hosting-data.io:3306'; //MEMO: enter persistent mode with prefix of "p:"
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
    //echo ('QUERY=["' . $sql . '"], ');
    $connection = getConnection();
    try {
        return $connection->query($sql);
    } finally {
        $connection->close();
    }
}

function getCount($table) {
    $result = query('SELECT COUNT(*) AS C FROM ' . $table);
    return $result->fetch_assoc()['C'];
}

function getWorkoutsAmount() {
    return getCount('workouts');
}

function getProgramsAmount() {
    return getCount('programs');
}

function getAllWorkouts() {
    return query('
        SELECT
            w.name AS id,
            w.ui_name AS name,
            w.description AS description,
            t.ui_value AS type,
            f.ui_value AS focus,
            d.ui_value AS difficulty
        FROM
            workouts w
            LEFT JOIN types t ON w.type_id = t.id
            LEFT JOIN focuses f ON w.focus_id = f.id
            LEFT JOIN diffculties d ON w.difficulty_id = d.id
    ');
}

function getAllPrograms() {
    return query('
        SELECT
            p.name AS id,
            p.ui_name AS name,
            p.description AS description,
            p.days AS days
        FROM
            programs p
    ');
}

function workoutIsInDatabase($name) {
    $result = query('SELECT id FROM workouts WHERE name = "' . $name . '"');
    return ($result->num_rows > 0);
}

function programIsInDatabase($name) {
    $result = query('SELECT id FROM programs WHERE name = "' . $name . '"');
    return ($result->num_rows > 0);
}

function createWorkout($name, $ui_name, $description, $focus_id, $type_id, $difficulty_id) {
    $insert_query = 'INSERT INTO workouts (name, ui_name, description, focus_id, type_id, difficulty_id) VALUES ("' . $name . '", "' . $ui_name . '", "' . $description . '", "' . $focus_id . '", "' . $type_id . '", "' . $difficulty_id . '")';
    query($insert_query);
}

function createProgram($name, $ui_name, $description, $days) {
    $insert_query = 'INSERT INTO programs (name, ui_name, description, days) VALUES ("' . $name . '", "' . $ui_name . '", "' . $description . '", ' . $days . ')';
    query($insert_query);
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
