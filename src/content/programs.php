<?php include 'overview-style.php' ?>
<table id="programs-table" class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Days</th>
        </tr>
    </thead>
    <tbody>
        <?php $programs = getAllPrograms(); ?>
        <?php if($programs->num_rows > 0): ?>
            <?php foreach ($programs as $key => $program): ?>
                <tr id="<?php echo $program['id'] ?>" program-description="<?php echo htmlspecialchars($program['description']) ?>">
                    <td class="program-name" details-target="<?php echo $program['id'] ?>"><strong><?php echo $program['name'] ?></strong></td>
                    <td class="days-col"><?php echo $program['days'] ?></td>
                </tr>
            <?php endforeach ?>
        <?php endif ?>
    </tbody>
</table>
<div id="info-modal" class="mobile-fullscreen workout-modal modal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <img id="intro-img" class="img-fluid" src="" alt="">
                    </div>
                    <div class="col-md-6">
                        <div id="program-description"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/resources/js/programs.js"></script>
