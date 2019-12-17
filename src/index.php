<!doctype html>
<html lang="en">
    <head>
        <title>Workouts | Marco Leweke</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="/resources/css/style.css">
    </head>
    <body class="container">
        <?php include 'assets.php'; ?>
        <?php if(authenticate()): ?>
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#system" data-toggle="tab">System</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="system" class="tab-pane active">
                    <button id="refreshDataBase" type="button" class="btn btn-primary">Fetch New Data From darebee.com</button>
                </div>
            </div>
            <div id="loader">
                <div class="loading-icon spinner-grow text-primary">

                </div>
            </div>
        <?php else: ?>
            <!-- load login -->
            <div id="login-card" class="card mt-2">
                <div class="card-header">
                    <h2>Login</h2>
                </div>
                <form action="index.php" method="post">
                <div class="card-body">
                    <input class="form-control mb-2" type="text" name="username" placeholder="Username">
                    <input class="form-control" type="password" name="password" placeholder="Password">
                </div>
                <div class="card-footer">
                    <input class="btn btn-primary" type="submit" value="Submit">
                </div>
                </form>
            </div>
        <?php endif ?>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script src="./resources/js/main.js"></script>
    </body>
</html>
