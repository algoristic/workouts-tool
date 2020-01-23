<?php include 'table-style.php' ?>
<?php include 'overview-style.php' ?>
<?php $isRoutinePage = ($_GET['page'] == 'routine'); ?>
<?php $isWorkoutsPage = ($_GET['page'] == 'workouts'); ?>
<div class="d-flex flex-row-reverse">
    <button class="toggle-btn btn btn-secondary btn-sm" data-toggle="collapse" data-target="#workout-search-area">
        <i class="btn-icon mr-1 fas fa-angle-up"></i>
        <span class="btn-text">Hide Search</span>
    </button>
</div>
<div id="workout-search-area" class="row px-2 collapse show">
    <div class="col-md-6">
        <div class="form-group">
            <label for="select-workout-1">Type:</label>
            <select id="select-workout-1" class="form-control">
                <option value=""></option>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="select-workout-2">Focus:</label>
            <select id="select-workout-2" class="form-control">
                <option value=""></option>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="select-workout-3">Difficulty:</label>
            <select id="select-workout-3" class="form-control">
                <option value=""></option>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-0">
            <label for="select-workout-name">Name:</label>
            <input id="select-workout-name" class="form-control" type="text"></input>
        </div>
    </div>
</div>
<table id="workouts-table" class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Type</th>
            <th>Focus</th>
            <th>Difficulty</th>
            <?php if($isRoutinePage): ?>
                <th>Action</th>
            <?php endif ?>
        </tr>
    </thead>
    <tbody>
        <?php $workouts = getAllWorkouts(); ?>
        <?php if($workouts->num_rows > 0): ?>
            <?php foreach ($workouts as $key => $workout): ?>
                <tr id="<?php echo $workout['id'] ?>"
                    class="hover-preview"
                    <?php if($isWorkoutsPage): ?>
                        workout-description="<?php echo htmlspecialchars($workout['description']) ?>"
                    <?php endif ?>>
                    <td class="workout-name" details-target="<?php echo $workout['id'] ?>" title="Show details on <?php echo $workout['id'] ?>"><strong><?php echo $workout['name'] ?></strong></td>
                    <td class="type-col"><?php echo $workout['type'] ?></td>
                    <td class="focus-col"><?php echo $workout['focus'] ?></td>
                    <td class="difficulty-col"><?php echo $workout['difficulty'] ?></td>
                    <?php if($isRoutinePage): ?>
                        <td><a class="use-workout btn btn-block" workout-id="<?php echo $workout['id'] ?>" title="Use this workout"><i class="fas fa-caret-right"></i></a></td>
                    <?php endif ?>
                </tr>
            <?php endforeach ?>
        <?php endif ?>
    </tbody>
</table>
<?php if($isWorkoutsPage): ?>
    <div id="info-modal" class="mobile-fullscreen modal-no-border modal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img id="detailed-instructions" class="img-fluid" src="" alt="">
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center">
                                    <img class="img-muscles img-fluid m-2" src="" alt="">
                                </div>
                                <div class="col-12">
                                    <table class="workout-table table table-borderless">
                                        <tbody>
                                            <tr>
                                                <th>Type</th>
                                                <td id="info-workout-type"></td>
                                            </tr>
                                            <tr>
                                                <th>Focus</th>
                                                <td id="info-workout-focus"></td>
                                            </tr>
                                            <tr>
                                                <th>Difficulty</th>
                                                <td id="info-workout-difficulty"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-left mt-2">
                            <div id="workout-description"></div>
                        </div>
                    </div>
                </div>
                <!--<div class="modal-footer">-->
                    <!--<button id="add-to-rotation" type="button" class="btn btn-primary btn-block" rotation-target="">Add to rotation&nbsp;&#x2192;</button>-->
                    <!--<button id="remove-from-rotation" type="button" class="btn btn-danger btn-block" rotation-target="">&#x2190;&nbsp;Remove from rotation</button>-->
                <!--</div>-->
            </div>
        </div>
    </div>
    <div id="preview-frame-desktop" class="d-none">
        <img src="" alt="Preview">
    </div>
    <div id="preview-frame-mobile" class="modal-no-border modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body d-flex justify-content-center">
                    <button id="go-back" type="button" class="btn btn-light preview-btn" preview-target="">&#xab;</button>
                    <img src="" alt="Preview">
                    <button id="go-forward" type="button" class="btn btn-light preview-btn" preview-target="">&#xbb;</button>
                </div>
                <div class="modal-footer">
                    <button id="show-details" type="button" class="btn btn-light btn-block" details-target="">Details</button>
                </div>
            </div>
        </div>
    </div>
    <script src="/resources/js/workouts.js"></script>
<?php endif ?>
<script type="text/javascript">
    $(function() {
        <?php if($isRoutinePage): ?>
            $('.use-workout').click(function() {
                let trainingId = wizard.id.get();
                let workoutId = $(this).attr('workout-id');
                let trainingPosition = wizard.context.get().dbContext;
                api.createSingleWorkout(trainingId, workoutId, trainingPosition, function(response) {
                    updateRoutine(trainingId, response.id);
                });
            });
        <?php endif ?>
        let table = $('#workouts-table').DataTable({
            ordering: false,
            lengthChange: false,
            searching: true,
            drawCallback: function() {
                visibleWorkouts = [];
                currentRows = 0;
                $('#workouts-table tbody tr').each(function(row) {
                    currentRows++;
                    visibleWorkouts.push($(this).attr('id'));
                });
            }
        });
        /* build searchfield for name-column */
        table.columns([0]).every(function() {
            let column = this;
            let input = $('#select-workout-name').on('keyup', function() {
                let val = $.fn.dataTable.util.escapeRegex(
                    $(this).val()
                );
                column.search(val ? val : '', true, false).draw();
            });
        });
        /* build dropdowns for type, focus & difficulty */
        table.columns([1, 2, 3]).every(function() {
            let column = this;
            let index = column[0][0];
            let select = $('#select-workout-' + index).on('change', function () {
                let val = $.fn.dataTable.util.escapeRegex(
                    $(this).val()
                );
                column.search(val ? '^' + val + '$' : '', true, false).draw();
            });
            column.data().unique().sort().each(function(d, j) {
                select.append('<option value="' + d + '">' + d + '</option>')
            });
        });
    });
</script>
