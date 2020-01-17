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
    $connection = getConnection();
    try {
        return $connection->query($sql);
    } finally {
        $connection->close();
    }
}

function insert($sql) {
    $connection = getConnection();
    try {
        if($connection->query($sql) === True) {
            return $connection->insert_id;
        } else {
            return Null;
        }
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
            p.days AS days,
            d.ui_value AS difficulty
        FROM
            programs p
            LEFT JOIN diffculties d ON p.difficulty_id = d.id
    ');
}

function getAllTrainingDays() {
    $user = $_SESSION['user_id'];
    return query('
        SELECT
            r.id AS id,
            r.name AS name,
            r.day AS day,
            r.done AS done,
            r.skipped AS skipped,
            r.pre_training_id AS pre_training_id,
            pre.category AS pre_training_category,
            r.main_training_id AS main_training_id,
            main.category AS main_training_category,
            r.post_training_id AS post_training_id,
            post.category AS post_training_category
        FROM
            routines r
            LEFT JOIN trainings pre ON r.pre_training_id = pre.id
            LEFT JOIN trainings main ON r.main_training_id = main.id
            LEFT JOIN trainings post ON r.post_training_id = post.id
        WHERE
            r.user = "' . $user . '"
        ORDER BY
            r.day ASC
    ');
}

function getTrainingCategory($trainingId) {
    return query('
        SELECT
            t.category AS category
        FROM
            trainings t
        WHERE
            t.id = ' . $trainingId . '
    ')->fetch_assoc()['category'];
}

function getWorkoutDescription($trainingId) {
    $workoutId = query('
        SELECT
            w.workout_id AS id
        FROM
            single_workouts w
        WHERE
            w.training_id = ' . $trainingId . '
    ')->fetch_assoc()['id'];
    $workout = query('
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
        WHERE
            w.id = ' . $workoutId . '
    ')->fetch_assoc();
    return 'Single Workout: ' . $workout['name'] . ' (' . $workout['type'] . ', ' . $workout['focus'] . ', ' . $workout['difficulty'] . ')';
}

function getProgramDescription($trainingId) {
    $programId = query('
        SELECT
            p.program_id AS id
        FROM
            program_workouts p
        WHERE
            p.training_id = ' . $trainingId . '
    ')->fetch_assoc()['id'];
    $program = query('
        SELECT
            p.name AS id,
            p.ui_name AS name,
            p.description AS description,
            p.days AS days,
            d.ui_value AS difficulty
        FROM
            programs p
            LEFT JOIN diffculties d ON p.difficulty_id = d.id
        WHERE
            p.id = ' . $programId . '
    ')->fetch_assoc();
    return 'Program Workout: ' . $program['name'] . ' (' . $program['days'] . ' days, ' . $program['difficulty'] . ')';
}

function createEmptyTraining($user, $day) {
    query('INSERT INTO routines (user, day) VALUES ("' . $user . '", ' . $day . ')');
    $result = query('
        SELECT
            MAX(r.id) AS id
        FROM
            routines r
        WHERE
            r.user = "' . $user . '"
    ');
    if($result->num_rows > 0) {
        return $result->fetch_assoc()['id'];
    } else {
        return Null;
    }
}

function createEmptySingleWorkout($workoutName) {
    $newWorkoutId = insert('INSERT INTO trainings (category) VALUES ("single_workouts")');
    $workoutPlanId = getWorkout($workoutName)->fetch_assoc()['id'];
    query('INSERT INTO single_workouts (workout_id, training_id) VALUES (' . $workoutPlanId . ', ' . $newWorkoutId . ')');
    return $newWorkoutId;
}

function createEmptySingleProgram($programName) {
    $newProgramId = insert('INSERT INTO trainings (category) VALUES ("program_workouts")');
    $programPlanId = getProgram($programName)->fetch_assoc()['id'];
    query('INSERT INTO program_workouts (program_id, training_id) VALUES (' . $programPlanId . ', ' . $newProgramId . ')');
    return $newProgramId;
}

function loadWorkout($id) {
    return query('
        SELECT
            t.id AS id,
            t.category AS category
        FROM
            trainings t
        WHERE
            t.id = ' . $id . '
    ');
}

function updateRoutine($routineId, $trainingId, $trainingPosition) {
    query('
        UPDATE
            routines r
        SET
            r.' . $trainingPosition. '_id = ' . $trainingId . '
        WHERE
            r.id = ' . $routineId . '
    ');
}

function removeTraining($id) {
    query('DELETE FROM routines WHERE id = ' . $id);
}

function updateTraining($id, $name) {
    query('
        UPDATE
            routines r
        SET
            r.name = "' . $name . '"
        WHERE
            r.id = ' . $id . '
    ');
}

function getWorkout($name) {
    return query('SELECT * FROM workouts w WHERE w.name = "' . $name . '"');
}

function getProgram($name) {
    return query('SELECT * FROM programs p WHERE p.name = "' . $name . '"');
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

function createProgram($name, $ui_name, $description, $days, $difficulty_id) {
    $insert_query = 'INSERT INTO programs (name, ui_name, description, days, difficulty_id) VALUES ("' . $name . '", "' . $ui_name . '", "' . $description . '", ' . $days . ', ' . $difficulty_id . ')';
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
