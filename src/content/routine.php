<?php include 'table-style.php' ?>
<?php include 'routine-style.php' ?>
<table id="training-days-table" class="table">
    <thead>
        <tr>
            <th>Day</th>
            <th>Name</th>
        </tr>
    </thead>
    <tbody>
        <?php $trainingDays = getAllTrainingDays(); ?>
        <?php if($trainingDays->num_rows > 0): ?>
            <?php foreach ($trainingDays as $key => $trainingDay): ?>
                <tr training-day-id="<?php echo $trainingDay['id'] ?>"
                    pre-training-id="<?php echo $trainingDay['pre_training_id'] ?>"
                    main-training-id="<?php echo $trainingDay['main_training_id'] ?>"
                    post-training-id="<?php echo $trainingDay['post_training_id'] ?>"
                    class="training-day training-active-<?php echo $trainingDay['active'] ?> training-done-<?php echo $trainingDay['done'] ?> training-skipped-<?php echo $trainingDay['skipped'] ?>">
                    <td class="training-day-day"><?php echo $trainingDay['day'] ?></td>
                    <td class="training-day-name"><?php echo $trainingDay['name'] ?></td>
                </tr>
            <?php endforeach ?>
        <?php endif ?>
    </tbody>
</table>
<div class="d-flex justify-content-center">
    <button id="add-training-day" type="button" class="btn btn-primary add-btn" title="Add training day">
        <span class="add-btn-text">+</span>
    </button>
</div>
<div id="training-day-wizard" edit-mode="" training-day-id="" edit-context="" training-day="" edit-context-mode="" class="mobile-fullscreen modal modal-no-border">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Training Day: <span id="training-day-subtype"></span></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="tab-content">
                    <div id="tab-none" class="tab-pane active"></div>
                    <div id="overview" class="tab-pane">
                        <div class="form-group">
                            <label for="training-day-name">Name:</label>
                            <input id="training-day-name" type="text" class="form-control" placeholder="Enter name for your training day">
                        </div>
                        <div class="form-check">
                            <label for="training-active" class="form-check-label">
                                <input id="training-active" type="checkbox" class="form-check-input">Active
                            </label>
                        </div>
                        <p>Warmup</p>
                        <div id="warmup-overview" class="d-none row">
                            <div class="col-2">
                                <button class="btn btn-light delete-btn" ui-context="warmup" db-context="pre" type="button"><i class="fas fa-trash"></i></button>
                            </div>
                            <div class="col-10">
                                <span class="description"></span>
                            </div>
                        </div>
                        <button id="add-warmup-btn" type="button" class="btn btn-light add-btn d-none" title="Add warmup">
                            <span class="add-btn-text">+</span>
                        </button>
                        <hr>
                        <p>Workout</p>
                        <div id="main-workout-overview" class="d-none row">
                            <div class="col-2">
                                <button class="btn btn-light delete-btn" ui-context="main-workout" db-context="main" type="button"><i class="fas fa-trash"></i></button>
                            </div>
                            <div class="col-10">
                                <span class="description"></span>
                            </div>
                        </div>
                        <button id="add-main-workout-btn" type="button" class="btn btn-light add-btn d-none" title="Add your main workout">
                            <span class="add-btn-text">+</span>
                        </button>
                        <hr>
                        <p>Cool down</p>
                        <div id="post-workout-overview" class="d-none row">
                            <div class="col-2">
                                <button class="btn btn-light delete-btn" ui-context="post-workout" db-context="post" type="button"><i class="fas fa-trash"></i></button>
                            </div>
                            <div class="col-10">
                                <span class="description"></span>
                            </div>
                        </div>
                        <button id="add-post-workout-btn" type="button" class="btn btn-light add-btn d-none" title="Add cool down">
                            <span class="add-btn-text">+</span>
                        </button>
                    </div>
                    <div id="workout-type-selection" class="tab-pane">
                        <div class="form-group">
                            <select class="form-control" id="type-selector">
                                <option value="single-workout">Single Workout</option>
                                <option value="program-workout">Workout Program</option>
                                <!-- <option value="filter-workout">Filter Selection</option> -->
                            </select>
                        </div>
                        <button id="select-btn" type="button" class="btn btn-primary btn-block">Continue</button>
                    </div>
                    <div id="single-workout" class="workout-type tab-pane">
                        <?php include 'workouts.php' ?>
                    </div>
                    <div id="program-workout" class="workout-type tab-pane">
                        <?php include 'programs.php' ?>
                    </div>
                    <div id="filter-workout" class="workout-type tab-pane">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div id="main-control">
                    <div class="d-flex">
                        <button id="cancel-changes" type="button" class="btn btn-secondary"><i class="fas fa-times mr-1"></i>Cancel</button>
                        <button id="save-changes" type="button" class="btn btn-primary ml-2"><i class="fas fa-save mr-1"></i>Save</button>
                        <button id="delete" type="button" class="btn btn-danger ml-2"><i class="fas fa-trash mr-1"></i>Delete</button>
                    </div>
                </div>
                <div id="sub-control" class="d-none">
                    <div class="d-flex">
                        <button id="cancel-workout-changes" type="button" class="btn btn-secondary"><i class="fas fa-times mr-1"></i>Cancel</button>
                        <!--
                        <button id="save-workout-changes" type="button" class="btn btn-primary">Save</button>
                        -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/resources/js/routine.js"></script>
<script src="/resources/js/api.js"></script>
<script src="/resources/js/routines.js"></script>
<script src="/resources/js/wizard.js"></script>
