<?php
function getActiveMarker($page) {
    if(isActivePage($page)) {
        return 'active';
    } else {
        return '';
    }
}

function isActivePage($page) {
    if(!empty($_GET['page'])) {
        return ($_GET['page'] === $page);
    } else {
        return ('workouts' === $page);
    }
}

function authenticate() {
    if(isset($_SESSION['user_id'])) {
        if(empty($_GET['page'])) {
            $_GET['page'] = 'workouts';
        }
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
            $_GET['page'] = 'workouts';
            return True;
        } else {
            return False;
        }
    }
}
?>
