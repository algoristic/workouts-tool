//$(function() {
//    $('#refreshDataBase').on('click', refreshDataBase());
//});

refreshDataBase = () => {
    $.ajax({
        url: 'https://workout.marco-leweke.de/api/fetch/workouts',
        success: (response) => {
            let msgText = 'Fetched ' + response.created + ' new workouts (' + response.total + ' total)';
            alert(msgText);
        }
    });
}
