<?php
include 'app.php';
function authenticate($username, $password) {
    if(('marco' === $username) && ('Test1234' === $password)) {
        main();
    } else {
        login('failed-attempt');
    }
}
?>
