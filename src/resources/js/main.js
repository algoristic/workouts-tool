$(() => {
    $('#refreshDataBase').click(() => {
        $('#loader').removeClass('d-none');
        $.ajax({
            url: 'https://workout.marco-leweke.de/api/fetch/workouts'
        }).done((response) => {
            let msgText = 'Fetched ' + response.created + ' new workouts (' + response.total + ' total)';
            alert(msgText);
            $('#loader').addClass('d-none');
        });
    });
});
