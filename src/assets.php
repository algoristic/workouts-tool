<?php
function authenticate() {
    if(isset($_SESSION['user_id'])) {
        return True;
    } else {
        $username = null;
        if(!empty($_GET['username'])) {
            $username = $_GET['username'];
        }
        $password = null;
        if(!empty($_GET['password'])) {
            $password = $_GET['password'];
        }
        if(('marco' === $username) && ('Test1234' === $password)) {
            $_SESSION['user_id'] = 'admin';
            return True;
        } else {
            return False;
        }
    }
}
?>
