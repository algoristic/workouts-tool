$(function() {
    var table = routines.DataTable({
        ordering: false,
        lengthChange: false,
        searching: false,
        paging: false,
        info: false,
        language: {
            emptyTable: 'No training days yet'
        }
    });
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

    $('#add-warmup-btn').click(function() {
        wizard.context.set(context.warmup);
    });
    $('#add-main-workout-btn').click(function() {
        wizard.context.set(context.mainWorkout);
    });
    $('#add-post-workout-btn').click(function() {
        wizard.context.set(context.cooldown);
    });
    $('#select-btn').click(function() {
        let workoutType = $('#type-selector').find(':selected').val();
        wizard.workoutType.set(workoutType);
        $('#sub-control').removeClass('d-none');
        $('#cancel-workout-changes').click(function() {
            wizard.clearWorkout(workoutType);
            wizard.context.set(context.overview);
        });
    });
    $('.use-workout').click(function() {
        let trainingId = wizard.id.get();
        let workoutId = $(this).attr('workout-id');
        let trainingPosition = wizard.context.get().dbContext;
        api.createSingleWorkout(trainingId, workoutId, trainingPosition, function(response) {
            alert(JSON.stringify(response));
        });
        wizard.context.set(context.overview);
    });
    $('.use-program').click(function() {
        let trainingId = wizard.id.get();
        let programId = $(this).attr('program-id');
        let trainingPosition = wizard.context.get().dbContext;
        api.createProgramWorkout(trainingId, programId, trainingPosition, function(response) {
            alert(JSON.stringify(response));
        })
        wizard.context.set(context.overview);
    });
});
