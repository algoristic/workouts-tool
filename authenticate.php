<?php
function authenticate($username, $password) {
    if(('marco' === $username) && ('Test1234' === $password)) {
        echo '<script type="text/javascript">alert("Hello " + "' . $username . '")</script>';
    } else {
        login('failed-attempt');
    }
}
?>
