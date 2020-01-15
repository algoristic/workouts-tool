/* WORKOUTS */
CREATE TABLE types(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    value VARCHAR(255) UNIQUE NOT NULL,
    ui_value VARCHAR(255)
);
CREATE TABLE focuses(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    value VARCHAR(255) UNIQUE NOT NULL,
    ui_value VARCHAR(255)
);
CREATE TABLE diffculties(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    value VARCHAR(255) UNIQUE NOT NULL,
    ui_value VARCHAR(255)
);
CREATE TABLE workouts(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL,
    ui_name VARCHAR(255) NOT NULL,
    description TEXT,
    type_id INT(6) UNSIGNED NOT NULL,
    focus_id INT(6) UNSIGNED NOT NULL,
    difficulty_id INT(6) UNSIGNED NOT NULL,
    FOREIGN KEY (type_id) REFERENCES types(id),
    FOREIGN KEY (focus_id) REFERENCES focuses(id),
    FOREIGN KEY (difficulty_id) REFERENCES diffculties(id)
);
/* PROGRAMS */
CREATE TABLE programs(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    ui_name VARCHAR(255) NOT NULL,
    description TEXT,
    days INT(6),
    difficulty_id INT(6) UNSIGNED  NOT NULL,
    FOREIGN KEY (difficulty_id) REFERENCES diffculties(id)
);
/* WORKOUT COLLECTIONS */
CREATE TABLE collections(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL
);
CREATE TABLE workouts_in_collection(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    workouts_id INT(6) UNSIGNED NOT NULL,
    collection_id INT(6) UNSIGNED NOT NULL,
    FOREIGN KEY (workouts_id) REFERENCES workouts(id),
    FOREIGN KEY (collection_id) REFERENCES collections(id)
);
/* TRAINING ROUTINES */
CREATE TABLE trainings(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(255) NOT NULL /* none, single_workouts, program_workouts, filter_workouts (, collection_workouts) */
);
CREATE TABLE single_workouts(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    workout_id INT(6) UNSIGNED NOT NULL,
    training_id INT(6) UNSIGNED NOT NULL,
    FOREIGN KEY (workout_id) REFERENCES workouts(id),
    FOREIGN KEY (training_id) REFERENCES trainings(id)
);
CREATE TABLE program_workouts(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    program_id INT(6) UNSIGNED NOT NULL,
    current_step INT(6) UNSIGNED DEFAULT 1,
    training_id INT(6) UNSIGNED NOT NULL,
    FOREIGN KEY (program_id) REFERENCES programs(id),
    FOREIGN KEY (training_id) REFERENCES trainings(id)
);
CREATE TABLE filter_workouts(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    type_id INT(6) UNSIGNED,
    focus_id INT(6) UNSIGNED,
    difficulty_id INT(6) UNSIGNED,
    training_id INT(6) UNSIGNED NOT NULL,
    FOREIGN KEY (type_id) REFERENCES types(id),
    FOREIGN KEY (focus_id) REFERENCES focuses(id),
    FOREIGN KEY (difficulty_id) REFERENCES diffculties(id),
    FOREIGN KEY (training_id) REFERENCES trainings(id)
);
CREATE TABLE collection_workouts(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    collection_id INT(6) UNSIGNED NOT NULL,
    training_id INT(6) UNSIGNED NOT NULL,
    FOREIGN KEY (collection_id) REFERENCES collection(id),
    FOREIGN KEY (training_id) REFERENCES trainings(id)
);
/* MEMO: Rest days will be stored by saving an empty entry :) */
/* MEMO: workouts (pre-, main- and post-) can consist of: none, single, program, filter (and collection) */
CREATE TABLE routines(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user VARCHAR(255) NOT NULL,
    name VARCHAR(255),
    day INT(6) UNSIGNED,
    done BOOLEAN DEFAULT 0,
    skipped BOOLEAN DEFAULT 0,
    pre_training_id INT(6) UNSIGNED,
    main_training_id INT(6) UNSIGNED,
    post_training_id INT(6) UNSIGNED,
    FOREIGN KEY (pre_training_id) REFERENCES trainings(id) ON DELETE CASCADE,
    FOREIGN KEY (main_training_id) REFERENCES trainings(id) ON DELETE CASCADE,
    FOREIGN KEY (post_training_id) REFERENCES trainings(id) ON DELETE CASCADE
);
CREATE TABLE workout_history(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user VARCHAR(255) NOT NULL,
    workout_id INT(6) UNSIGNED,
    workout_date DATETIME,
    skipped BOOLEAN,
    FOREIGN KEY (workout_id) REFERENCES workouts(id)
);
