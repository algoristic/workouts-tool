<?php include 'table-style.php' ?>
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
                <tr id="<?php echo $program['id'] ?>" class="hover-preview" program-description="<?php echo htmlspecialchars($program['description']) ?>">
                    <td class="program-name" details-target="<?php echo $program['id'] ?>"><strong><?php echo $program['name'] ?></strong></td>
                    <td class="days-col"><?php echo $program['days'] ?></td>
                </tr>
            <?php endforeach ?>
        <?php endif ?>
    </tbody>
</table>
<div id="preview-frame-desktop" class="d-none">
    <img src="" alt="Preview">
</div>
<div id="info-modal" class="mobile-fullscreen workout-modal modal">
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
