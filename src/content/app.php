<?php
$tabs = array(
    'today' => array('Training', 'dumbbell'),
    'routine' => array('Routine', 'file-signature'),
    'workouts' => array('Workouts', 'running'),
    'programs' => array('Programs', 'clipboard'),
    'system' => array('System', 'cogs')
);
?>
<div id="app-wrapper">
    <!-- MAIN MENU -->
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <button class="ml-auto navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <?php foreach ($tabs as $tab => $data): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo getActiveMarker($tab); ?>" href="/?page=<?php echo $tab ?>">
                            <i class="fas fa-<?php echo $data[1] ?>"></i>
                            <?php echo $data[0] ?>
                        </a>
                    </li>
                <?php endforeach ?>
                    <li class="nav-item">
                        <a class="nav-link text-secondary" href="./logout.php">
                            <i class="fas fa-sign-out-alt"></i>
                            Logout
                        </a>
                    </li>
            </ul>
        </div>
    </nav>
    <!-- END MAIN MENU -->

    <!-- APP CONTENTS -->
    <div class="tab-content main-app container">
        <?php foreach ($tabs as $tab => $data): ?>
            <div class="tab-pane <?php echo getActiveMarker($tab); ?>">
                <?php if(isActivePage($tab)): ?>
                    <?php include ($tab . ".php"); ?>
                <?php endif ?>
            </div>
        <?php endforeach ?>
        <!-- END APP CONTENTS -->
    </div>
</div>
