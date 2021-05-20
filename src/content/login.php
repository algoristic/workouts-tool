<div id="login-card" class="card mt-2">
    <div class="card-header">
        <h2>Login</h2>
    </div>
    <form action="index.php" method="post">
        <div class="card-body">
            <?php $username = $_GET['username']; ?>
            <?php $usernameExists = ($username !== NULL) ?>
            <input class="form-control mb-2" type="text" name="username" placeholder="Username"
            <?php if($usernameExists): ?>
                value="<?php echo $username ?>"
            <?php endif ?>
            >
            <input class="form-control" type="password" name="password" placeholder="Password">
        </div>
        <div class="card-footer">
            <input class="btn btn-primary" type="submit" value="Submit">
        </div>
    </form>
</div>
