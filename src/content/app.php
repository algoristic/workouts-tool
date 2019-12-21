<div class="card">
    <!-- MAIN MENU -->
    <ul class="card-header nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link <?php echo getActiveMarker('workouts'); ?>" href="#workouts" data-toggle="tab">Workouts</a>
        </li>
        <li class="nav-item">
            <a class="nav-link  <?php echo getActiveMarker('system'); ?>" href="#system" data-toggle="tab">System</a>
        </li>
    </ul>
    <!-- END MAIN MENU -->

    <!-- APP CONTENTS -->
    <div class="card-body tab-content">
        <div id="workouts" class="tab-pane <?php echo getActiveMarker('workouts'); ?>">
            <?php if(isActivePage('workouts')): ?>
                <?php include "workouts.php"; ?>
            <?php endif ?>
        </div>
        <div id="system" class="tab-pane <?php echo getActiveMarker('system'); ?>">
            <?php if(isActivePage('system')): ?>
                <?php include "system.php"; ?>
            <?php endif ?>
        </div>
    </div>
    <!-- END APP CONTENTS -->
</div>
