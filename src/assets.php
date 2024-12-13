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
        'test' => 'Test1234',
        'marco' => 'Test1234',
        'pia' => 'Test1234'
    );
    if(isset($_SESSION['user_id'])) {
        if(empty($_GET['page'])) {
            $_GET['page'] = 'today';
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
                    $_GET['page'] = 'today';
                }
                storeUser($user);
                return True;
            }
        }
        return False;
    }
}

function storeUser($username) {
    $html = '<script type="text/javascript">';
    $html .= 'sessionStorage["username"] = "' . $username . '";';
    $html .= '</script>';
    echo $html;
}
?>
