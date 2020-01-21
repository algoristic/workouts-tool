<?php include 'table-style.php' ?>
<?php include 'today-style.php' ?>
<?php
$isFinished = True;
$routineCtx = 'finished';
$trainingCtx = 'finished';
$id = Null;
$isLastWorkout = False;
$link = '';
$day = Null;
$days = Null;
if(userHasRoutines()) {
    $routines = getOpenRoutines();
    if($routines->num_rows < 1) {
        if(!lastDoneTrainingWasToday()) {
            resetRoutines();
            $routines = getOpenRoutines();
        }
    }
    $routine = $routines->fetch_assoc();
    $routineId = $routine['id'];
    $pre_id = $routine['pre'];
    $main_id = $routine['main'];
    $post_id = $routine['post'];
    $last_id = Null;
    //determine last training step: (when the last training step is done - the whole routine is set to 'done'!)
    foreach(array($post_id, $main_id, $pre_id) as $ptId) {
        if($ptId != Null) {
            $last_id = $ptId;
            break;
        }
    }
    if($last_id != Null) {
        foreach(array('pre' => $pre_id, 'main' => $main_id, 'post' => $post_id) as $routineContext => $trainingId) {
            if($trainingId == Null) {
                continue;
            } else {
                $training = getTraining($trainingId)->fetch_assoc();
                if($training['done']) {
                    continue;
                } else {
                    $isFinished = False;
                    $category = $training['category'];
                    $trainingCtx = $category;
                    $routineCtx = $routineContext;
                    $id = $trainingId;
                    $isLastWorkout = ($id == $last_id);
                    $link = './media/';
                    switch ($category) {
                        case 'single_workouts':
                            $link .= 'workouts/';
                            $link .= getWorkoutName($id);
                            $link .= '/instructions.jpg';
                            break;
                        case 'program_workouts':
                            $program = getProgramByTraining($id);
                            $trainingDay = $program['day'];
                            $day = $trainingDay;
                            $days = $program['days'];
                            $link .= 'programs/';
                            $link .= $program['name'];
                            $link .= '/day-';
                            $link .= $trainingDay;
                            $link .= '.jpg';
                            break;
                        default:
                            //assert: this should never happen...
                            break;
                    }
                    break;
                }
            }
        }
    }
}
?>
<script type="text/javascript">
    category = '<?php echo $trainingCtx ?>';
    training = {
        name: '<?php echo $routineCtx ?>'<?php if($id != Null): ?>,
        id: <?php echo $id ?><?php endif; ?>
    };
</script>
<div id="panel" class="tab-content text-center">
    <div class="tab-pane active">
        <div id="head">

        </div>
        <div id="content">
            <?php if($isFinished): ?>
                <p>
                    <i class="fas fa-dumbbell fa-3x"></i>
                </p>
                <p>
                    You are finished &mdash; <span style="text-decoration:underline">for today</span>!
                </p>
            <?php else: ?>
                <div class="row">
                    <div class="col-lg-4 offset-lg-4">
                        <img class="mx-3 img-fluid" src="<?php echo $link ?>">
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>
<div class="mx-2 mt-3 row">
    <div id="workout-controls"
        class="col-lg-4 offset-lg-4"
        is-last-step="<?php if($isLastWorkout) {
            echo 'true';
        } else {
            echo 'false';
        } ?>"
        <?php if($day != Null): ?>
            day="<?php echo($day) ?>"
        <?php endif ?>
        <?php if($days != Null): ?>
            all-days="<?php echo($days) ?>"
        <?php endif ?>
        routine="<?php echo($routineId) ?>"
        ></div>
</div>
<script src="/resources/js/api.js"></script>
<script src="/resources/js/today.js"></script>
