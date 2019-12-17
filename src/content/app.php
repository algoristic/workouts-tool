<div class="card">
    <!-- MAIN MENU -->
    <ul class="card-header nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" href="#workouts" data-toggle="tab">Workouts</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#system" data-toggle="tab">System</a>
        </li>
    </ul>
    <!-- END MAIN MENU -->

    <!-- APP CONTENTS -->
    <div class="card-body tab-content">
        <div id="workouts" class="tab-pane active">
            <?php include "workouts.php"; ?>
        </div>
        <div id="system" class="tab-pane">
            <h2>System</h2>
            <button id="refreshDataBase" type="button" class="btn btn-primary">Fetch New Data From darebee.com</button>
        </div>
    </div>
    <!-- END APP CONTENTS -->
</div>
