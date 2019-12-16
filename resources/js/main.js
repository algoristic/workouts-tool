$(function() {
    $('#refreshDataBase').click(refreshDataBase());
});

refreshDataBase = () => {
    $.ajax({
        url: 'https://workout.marco-leweke.de/api/fetch/workouts.php',
        success: (result) => {
            alert(result);
        }
    });
}
