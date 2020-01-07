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
    $users = array(
        'marco' => 'Test1234',
        'pia' => 'TestLol'
    );
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
        foreach($users as $user => $pw) {
            if(($username === $user) && ($pw === $password)) {
                $_SESSION['user_id'] = $user;
                if(!isset($_GET['page'])) {
                    $_GET['page'] = 'workouts';
                }
                return True;
            }
        }
        return False;
    }
}
?>
