<?php
function authenticate() {
    return true; //todo -> implement POST-authentication
    $username = null;
    if(!empty($_POST['username'])) {
        $username = $_POST['username'];
    }
    $password = null;
    if(!empty($_POST['password'])) {
        $password = $_POST['password'];
    }
    return (('marco' === $username) && ('Test1234' === $password));
}
?>
