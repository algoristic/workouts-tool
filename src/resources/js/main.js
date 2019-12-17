isMobile = false;

function load() {
    $('#loader').removeClass('d-none');
}

function ready() {
    $('#loader').addClass('d-none');
}

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

    isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    if(isMobile) {
        $('.hover-preview').click(function() {
            let workout = $(this).attr('id');
            let src = './media/workouts/' + workout + '/preview.jpg';
            $('#preview-frame-mobile img').attr('src', src);
            $('#preview-frame-mobile').modal();
        });
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
