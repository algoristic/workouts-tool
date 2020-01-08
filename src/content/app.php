<?php
$tabs = array(
    'today' => 'Today',
    'routine' => 'Routine',
    'workouts' => 'Workouts',
    'programs' => 'Programs',
    'system' => 'System'
);
?>
<div class="card">
    <!-- MAIN MENU -->
    <ul class="card-header nav nav-pills">
        <?php foreach ($tabs as $tab => $name): ?>
            <li class="nav-item">
                <a class="nav-link <?php echo getActiveMarker($tab); ?>" href="#<?php echo $tab ?>"><?php echo $name ?></a>
            </li>
        <?php endforeach ?>
            <li class="ml-auto nav-item">
                <a class="nav-link text-secondary" href="./logout.php">Logout</a>
            </li>
    </ul>
    <!-- END MAIN MENU -->

    <!-- APP CONTENTS -->
    <div class="card-body tab-content">
        <?php foreach ($tabs as $tab => $name): ?>
            <div class="tab-pane <?php echo getActiveMarker($tab); ?>">
                <?php if(isActivePage($tab)): ?>
                    <?php include ($tab . ".php"); ?>
                <?php endif ?>
            </div>
        <?php endforeach ?>
        <!-- END APP CONTENTS -->
    </div>
</div>
