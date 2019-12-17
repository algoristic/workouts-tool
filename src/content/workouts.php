<table id="workouts-table" class="table" style="width:100%">
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
    <img src="" alt="Dark Elf Workout">
</div>
