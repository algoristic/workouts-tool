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
        if(!empty($_REQUEST['username'])) {
            $username = $_REQUEST['username'];
        }
        $password = null;
        if(!empty($_REQUEST['password'])) {
            $password = $_REQUEST['password'];
        }
        if(('marco' === $username) && ('Test1234' === $password)) {
            $_SESSION['user_id'] = 'admin';
            if(!isset($_GET['page'])) {
                $_GET['page'] = 'workouts';
            }
            return True;
        } else {
            return False;
        }
    }
}
?>
