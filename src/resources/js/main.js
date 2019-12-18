isMobile = false;

function load() {
    $('#loader').removeClass('d-none');
}

function ready() {
    $('#loader').addClass('d-none');
}

function getPreview(elem) {
    let workout = elem.attr('id');
    let src = './media/workouts/' + workout + '/preview.jpg';
    return src;
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
            let src = getPreview($(this));
            $('#preview-frame-mobile img').attr('src', src);
            /*$('#preview-frame-mobile img').removeAttr('onclick');
            $('#preview-frame-mobile img').click(function() {

            });*/
            $('#preview-frame-mobile').modal();
        });
    } else {
        $('.hover-preview').mouseenter(function() {
            let src = getPreview($(this));
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
