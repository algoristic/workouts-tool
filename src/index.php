<?php session_start(); ?>
<!doctype html>
<html lang="en">
    <head>
        <title>Workouts | Marco Leweke</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="/resources/css/style.css">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
        <script defer="" src="https://use.fontawesome.com/releases/v5.5.0/js/all.js" integrity="sha384-GqVMZRt5Gn7tB9D9q7ONtcp4gtHIUEW/yG7h98J7IpE3kpi+srfFyyB/04OV6pG0" crossorigin="anonymous"></script>
        <script src="/resources/js/requestParams.js"></script>
        <script src="/resources/js/main.js"></script>
    </head>
    <body class="container">
        <?php include 'assets.php'; ?>
        <?php include 'database.php'; ?>
        <?php if(authenticate()): ?>
            <?php include './content/app.php'; ?>
            <div id="loader" class="d-none">
                <div class="loading-icon spinner-grow text-primary"></div>
            </div>
        <?php else: ?>
            <?php include './content/login.php'; ?>
        <?php endif ?>
    </body>
</html>
