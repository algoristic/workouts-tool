    <?php include 'table-style.php' ?>
<?php include 'overview-style.php' ?>
<?php $isRoutinePage = ($_GET['page'] == 'routine'); ?>
<?php $isProgramsPage = ($_GET['page'] == 'programs'); ?>
<table id="programs-table" class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Difficulty</th>
            <th>Days</th>
            <?php if($isRoutinePage): ?>
                <th>Action</th>
            <?php endif ?>
        </tr>
    </thead>
    <tbody>
        <?php $programs = getAllPrograms(); ?>
        <?php if($programs->num_rows > 0): ?>
            <?php foreach ($programs as $key => $program): ?>
                <tr id="<?php echo $program['id'] ?>"
                    class="hover-preview"
                    <?php if($isProgramsPage): ?>
                        program-description="<?php echo htmlspecialchars($program['description']) ?>"
                    <?php endif ?>>
                    <td class="program-name" details-target="<?php echo $program['id'] ?>"><strong><?php echo $program['name'] ?></strong></td>
                    <td class="program-difficulty"><?php echo $program['difficulty'] ?></td>
                    <td class="days-col"><?php echo $program['days'] ?></td>
                    <?php if($isRoutinePage): ?>
                        <td><a class="use-program btn btn-block" program-id="<?php echo $program['id'] ?>" title="Use this program"><i class="fas fa-caret-right"></i></a></td>
                    <?php endif ?>
                </tr>
            <?php endforeach ?>
        <?php endif ?>
    </tbody>
</table>
<?php if($isProgramsPage): ?>
    <div id="preview-frame-desktop" class="d-none">
        <img src="" alt="Preview">
    </div>
    <div id="info-modal" class="mobile-fullscreen modal-no-border modal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div id="days-overview" class="d-flex justify-content-center">
                                <button id="go-back" type="button" class="btn btn-light preview-btn" preview-target="">&#xab;</button>
                                <img src="" alt="" preview-program="">
                                <button id="go-forward" type="button" class="btn btn-light preview-btn" preview-target="">&#xbb;</button>
                            </div>
                        </div>
                        <div class="col-12 d-flex align-items-center">
                            <div id="program-description"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="/resources/js/programs.js"></script>
<?php endif ?>
<script type="text/javascript">
    $(function() {
        <?php if($isRoutinePage): ?>
            $('.use-program').click(function() {
                let trainingId = wizard.id.get();
                let programId = $(this).attr('program-id');
                let trainingPosition = wizard.context.get().dbContext;
                api.createProgramWorkout(trainingId, programId, trainingPosition, function(response) {
                    updateRoutine(trainingId, response.id);
                });
            });
        <?php endif ?>
        $('#programs-table').DataTable({
            ordering: false,
            lengthChange: false,
            stateSave: true
        });
    });
</script>
