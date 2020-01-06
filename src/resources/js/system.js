$(function() {
    $('#fetchWorkouts').click(function() {
        load();
        $.ajax({
            url: 'https://workout.marco-leweke.de/api/fetch/workouts'
        }).done((response) => {
            alert('Fetched ' + response.created + ' new workouts (' + response.total + ' total)');
            ready();
        });
    });
    $('#fetchPrograms').click(function() {
        load();
        $.ajax({
            url: 'https://workout.marco-leweke.de/api/fetch/programs'
        }).done((response) => {
            alert('Fetched ' + response.created + ' new programs (' + response.total + ' total)');
            ready();
        });
    });
});
