isMobile = false;

$(function() {
    $('#refreshDataBase').click(function() {
        $('#loader').removeClass('d-none');
        $.ajax({
            url: 'https://workout.marco-leweke.de/api/fetch/workouts'
        }).done((response) => {
            alert('Fetched ' + response.created + ' new workouts (' + response.total + ' total)');
            $('#loader').addClass('d-none');
        });
    });

    isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    if(isMobile) {

    } else {
        $('.hover-preview').mouseenter(function() {
            let workout = $(this).attr('id');
            let src = './media/workouts/' + workout + '/preview.jpg';
            $('#preview-frame-desktop img').attr('src', src);
            $('#preview-frame-desktop').removeClass('d-none');
        });
        $('.hover-preview').mouseleave(function() {
            $('#preview-frame-desktop').addClass('d-none');
        });
    }

    $('#workouts-table').DataTable({
        ordering: false,
        lengthChange: false,
        stateSave: true
    });
});
