$(function() {
    $('#refreshDataBase').click(function() {
        load();
        $.ajax({
            url: 'https://workout.marco-leweke.de/api/fetch/workouts'
        }).done((response) => {
            alert('Fetched ' + response.created + ' new workouts (' + response.total + ' total)');
            ready();
        });
    });
});
