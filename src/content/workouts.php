<table id="workouts-table" class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Type</th>
            <th>Focus</th>
            <th>Difficulty</th>
        </tr>
    </thead>
    <tbody>
        <?php $workouts = getAllWorkouts(); ?>
        <?php if($workouts->num_rows > 0): ?>
            <?php foreach ($workouts as $key => $workout): ?>
                <tr id="<?php echo $workout['id'] ?>" class="hover-preview">
                    <td class="workout-name"><strong><?php echo $workout['name'] ?></strong></td>
                    <td><?php echo $workout['type'] ?></td>
                    <td><?php echo $workout['focus'] ?></td>
                    <td><?php echo $workout['difficulty'] ?></td>
                </tr>
            <?php endforeach ?>
        <?php endif ?>
    </tbody>
</table>
<div id="preview-frame-desktop" class="d-none">
    <img src="" alt="Preview">
</div>
<div id="preview-frame-mobile" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close absolute-close" data-dismiss="modal">&times;</button>
            <div class="modal-body d-flex justify-content-center">
                <img src="" alt="Preview">
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>