isMobile = false;
visibleWorkouts = [];
currentRows = 0;

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

function setNavigation(workout) {
    let index = 0;
    for(i = 0; i < visibleWorkouts.length; i++) {
        let currentWorkout = visibleWorkouts[i];
        if(currentWorkout === workout) {
            index = i;
            break;
        }
    }
    //set go-back button
    if(index <= 0) {
        $('#go-back').prop('disabled', true);
    } else {
        $('#go-back').prop('disabled', false);
        let goBackTarget = visibleWorkouts[index - 1];
        $('#go-back').attr('preview-target', goBackTarget);
    }
    //set preview image
    let src = './media/workouts/' + workout + '/preview.jpg';
    let darebeeLink = 'https://darebee.com/workouts/' + workout;
    $('#preview-frame-mobile img').attr('src', src);
    $('#preview-darebee-link').attr('href', darebeeLink);
    //set go-forward button
    if(index >= (currentRows - 1)) {
        $('#go-forward').prop('disabled', true);
    } else {
        $('#go-forward').prop('disabled', false);
        let goForwardTarget = visibleWorkouts[index + 1];
        $('#go-forward').attr('preview-target', goForwardTarget);
    }
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
            let elem = $(this);
            let workout = elem.attr('id');
            setNavigation(workout);
            /*$('#preview-frame-mobile img').removeAttr('onclick');
            $('#preview-frame-mobile img').click(function() {

            });*/
            $('#preview-frame-mobile').modal();
        });
        $('#go-back, #go-forward').click(function() {
            setNavigation($(this).attr('preview-target'));
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
        stateSave: true,
        drawCallback: function() {
            visibleWorkouts = [];
            currentRows = 0;
            $('#workouts-table tbody tr').each(function(row) {
                currentRows++;
                visibleWorkouts.push($(this).attr('id'));
            });
        }
    });
});
