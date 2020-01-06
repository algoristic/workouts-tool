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
                    <td class="program-name"><strong><?php echo $program['name'] ?></strong></td>
                    <td class="days-col"><?php echo $program['days'] ?></td>
                </tr>
            <?php endforeach ?>
        <?php endif ?>
    </tbody>
</table>
<script src="/resources/js/programs.js"></script>
