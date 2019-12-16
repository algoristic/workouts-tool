<?php
function authenticate() {
    $username = null;
    if(!empty($_GET['username'])) {
        $username = $_GET['username'];
    }
    $password = null;
    if(!empty($_GET['password'])) {
        $password = $_GET['password'];
    }
    return (('marco' === $username) && ('Test1234' === $password));
}
?>
