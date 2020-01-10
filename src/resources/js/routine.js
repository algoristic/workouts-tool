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
    })
    $('#save-changes').click(function() {

    });
    $('#cancel-changes').click(function() {
        wizard.cancel();
        wizard.modal('hide');
    });
});
