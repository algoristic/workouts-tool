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
                    <td class="workout-name" details-target="<?php echo $workout['id'] ?>" title="Show details on <?php echo $workout['id'] ?>"><strong><?php echo $workout['name'] ?></strong></td>
                    <td class="type-col"><?php echo $workout['type'] ?></td>
                    <td class="focus-col"><?php echo $workout['focus'] ?></td>
                    <td class="difficulty-col"><?php echo $workout['difficulty'] ?></td>
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
                        <img id="detailed-instructions" class="img-fluid" src="" alt="">
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center">
                                <img class="img-muscles img-fluid" src="" alt="">
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
<div id="preview-frame-mobile" class="workout-modal modal">
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
