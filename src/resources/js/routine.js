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
        wizard.modal();
    })
});
