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
                <tr training-day-id="<?php echo $trainingDay['id'] ?>" class="training-done-<?php echo $trainingDay['done'] ?> training-skipped-<?php echo $trainingDay['skipped'] ?>">
                    <td><?php echo $trainingDay['day'] ?></td>
                    <td><?php echo $trainingDay['name'] ?></td>
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
<div id="training-day-wizard" edit-mode="" training-day-id="" class="modal modal-no-border">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Training Day:</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="training-day-name">Name:</label>
                    <input id="training-day-name" type="text" class="form-control" placeholder="Enter name for your training day">
                </div>
                <p>Warmup</p>
                <div class="d-flex justify-content-center">
                    <button id="add-warmup-btn" type="button" class="btn btn-light add-btn" title="Add warmup">
                        <span class="add-btn-text">+</span>
                    </button>
                </div>
                <hr>
                <p>Workout</p>
                <div class="d-flex justify-content-center">
                    <button id="add-main-workout-btn" type="button" class="btn btn-light add-btn" title="Add your main workout">
                        <span class="add-btn-text">+</span>
                    </button>
                </div>
                <hr>
                <p>Cool down</p>
                <div class="d-flex justify-content-center">
                    <button id="add-post-workout-btn" type="button" class="btn btn-light add-btn" title="Add cool down">
                        <span class="add-btn-text">+</span>
                    </button>
                </div>
            </div>
            <div class="modal-footer d-flex">
                <button id="cancel-changes-training-day" type="button" class="btn btn-secondary">Cancel</button>
                <button id="save-changes-training-day" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
<script src="/resources/js/routine.js"></script>
