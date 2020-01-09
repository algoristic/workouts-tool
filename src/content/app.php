<?php
$tabs = array(
    'today' => 'Today',
    'routine' => 'Routine',
    'workouts' => 'Workouts',
    'programs' => 'Programs',
    'system' => 'System'
);
?>
<div id="app-wrapper">
    <!-- MAIN MENU -->
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <?php foreach ($tabs as $tab => $name): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo getActiveMarker($tab); ?>" href="#<?php echo $tab ?>"><?php echo $name ?></a>
                    </li>
                <?php endforeach ?>
                    <li class="ml-auto nav-item">
                        <a class="nav-link text-secondary" href="./logout.php">Logout</a>
                    </li>
            </ul>
        </div>
    </nav>
    <!-- END MAIN MENU -->

    <!-- APP CONTENTS -->
    <div class="tab-content container">
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
