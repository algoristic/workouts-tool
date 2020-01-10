routines = $('#training-days-table');
routines.trainingDays = () => {
    let days = [];
    routines.find('.training-day').each(function() {
        let id = $(this).attr('training-day-id');
        let day = $(this).find('.training-day-day').text();
        let name = $(this).find('training-day-name').text();
        days.push({
            id: id,
            day: day,
            name: name
        });
    });
    return days;
}
routines.daysOnly = () => {
    let days = [];
    routines.trainingDays().forEach(function(trainingDay) {
        days.push(trainingDay.day);
    });
    return days;
}
routines.lastDay = () => {
    return Math.max(...routines.daysOnly());
}
