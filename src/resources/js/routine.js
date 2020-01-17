function updateRoutine(trainingId, subWorkoutId) {
    let context = wizard.context.get();
    let training = $('tr[training-day-id="' + trainingId + '"]');
    training.attr(context.routineContext + '-id', subWorkoutId);
    if(wizard.mode.get() === mode.create) {
        wizard.save();
    }
    wizard.loadTraining(training);
}

table = undefined;

$(function() {
    var routinesTable = routines.DataTable({
        ordering: false,
        lengthChange: false,
        searching: false,
        paging: false,
        info: false,
        language: {
            emptyTable: 'No training days yet'
        }
    });
    table = routinesTable;
    $('#add-training-day').click(function() {
        wizard.newTraining();
        wizard.modal('show');
    });
    $('.training-day').click(function() {
        wizard.loadTraining($(this));
        wizard.modal('show');
    });
    $('#save-changes').click(function() {
        wizard.save();
        wizard.modal('hide');
    });
    $('#cancel-changes').click(function() {
        wizard.cancel();
        wizard.modal('hide');
    });
    $('#delete').click(function() {
        wizard.delete();
        wizard.modal('hide');
    });
    $('#add-warmup-btn').click(function() {
        wizard.context.set(context.warmup);
    });
    $('#add-main-workout-btn').click(function() {
        wizard.context.set(context.mainWorkout);
    });
    $('#add-post-workout-btn').click(function() {
        wizard.context.set(context.cooldown);
    });
    $('.delete-btn').click(function() {
        let trainingId = wizard.id.get();
        let trainingPosition = $(this).attr('db-context');
        let uiContext = $(this).attr('ui-context');
        api.deleteSubWorkout(trainingId, trainingPosition, function(response) {
            wizard.addButton(uiContext);
            $('tr[training-day-id="' + trainingId + '"]').attr(trainingPosition + '-training-id', '');
        });
    });
    $('#cancel-workout-changes').click(function() {
        wizard.context.set(context.overview);
    });
    $('#select-btn').click(function() {
        let workoutType = $('#type-selector').find(':selected').val();
        wizard.workoutType.set(workoutType);
        $('#sub-control').removeClass('d-none');
    });
    $('#training-day-name').blur(function() {
        let id = wizard.id.get();
        let name = wizard.trainingName.get();
        b64name = btoa(name);
        api.updateTraining(id, b64name, function(response) {
            $('tr[training-day-id="' + id + '"] .training-day-name').text(name);
        });
    });
});
