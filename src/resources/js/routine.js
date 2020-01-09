cancelTrainingWork = function() {
    let wizard = $('#training-day-wizard');
    let mode = wizard.attr('edit-mode');
    if(mode === 'create') {
        let id = wizard.attr('training-day-id');
        $.ajax({
            url: 'https://workout.marco-leweke.de/api/deleteTraining?id=' + id
        });
    }
    wizard.attr('edit-mode', '');
    wizard.attr('training-day-id', '');
}
$(function() {
    let user = sessionStorage["username"];
    var table = $('#training-days-table').DataTable({
        ordering: false,
        lengthChange: false,
        searching: false,
        paging: false,
        info: false,
        language: {
            emptyTable: 'No training days yet'
        }
    });
    $('#cancel-changes-training-day').click(function() {
        cancelTrainingWork();
        $('#training-day-wizard').modal('hide');
    });
    $('#add-warmup-btn').click(function() {

    });
    let wizard = $('#training-day-wizard');
    $('#add-training-day').click(function() {
        wizard.attr('edit-mode', 'create');
        $.ajax({
            url: 'https://workout.marco-leweke.de/api/createTraining?user=' + user
        }).done((response) => {
            if(response.status === 'Error') {
                alert("An error occurred: Please reload the application!")
                cancelTrainingWork();
            } else {
                wizard.attr('training-day-id', response.id);
            }
        });
        $('#save-changes-training-day').click(function() {

        });
        wizard.modal();
    })
});
