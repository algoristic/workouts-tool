<?php
function login($login_param) {
    $failed_attempt = ('failed-attempt' === $login_param);
    $html = '
    <form type="GET" action="/index.php">
        <div id="login-card" class="card">
            <div class="card-header">
                <h2>Login</h2>
            </div>
            <div class="card-body">
                <input class="form-control mb-2" type="text" name="username" placeholder="Username">
                <input class="form-control" type="password" name="password" placeholder="Password">';
    if($failed_attempt) {
        $html .= '
            <div class="alert alert-warning mt-2">
                <strong>Failed</strong> login attempt!
            </div>
        ';
    }
    $html .= '
            </div>
            <div class="card-footer">
                <input class="btn btn-primary" type="submit" value="Submit">
            </div>
        </div>
    </form>
    ';
    echo $html;
}
?>
