visibleWorkouts = [];
currentRows = 0;

function getWorkoutMediaLink(workout) {
    return './media/workouts/' + workout;
}

function getPreviewLink(workout) {
    return (getWorkoutMediaLink(workout) + '/preview.jpg');
}

function getInstructionLink(workout) {
    return (getWorkoutMediaLink(workout) + '/instructions.jpg');
}

function getMusclesLink(workout) {
    return (getWorkoutMediaLink(workout) + '/muscles.jpg');
}

function setNavigation(workout) {
    $('#preview-frame-mobile img').attr('src', '');
    let index = 0;
    for(i = 0; i < visibleWorkouts.length; i++) {
        let currentWorkout = visibleWorkouts[i];
        if(currentWorkout === workout) {
            index = i;
            break;
        }
    }
    $('#show-details').attr('details-target', workout);
    $('#preview-frame-mobile img').attr('details-target', workout);
    //set go-back button
    if(index <= 0) {
        $('#go-back').prop('disabled', true);
    } else {
        $('#go-back').prop('disabled', false);
        let goBackTarget = visibleWorkouts[index - 1];
        $('#go-back').attr('preview-target', goBackTarget);
    }
    //set preview image
    let src = getPreviewLink(workout);
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

function openInfoModal(workout) {
    $('#detailed-instructions').attr('src', '');
    let instructionsLink = getInstructionLink(workout);
    $('#detailed-instructions').attr('src', instructionsLink);
    let musclesLink = getMusclesLink(workout);
    $('.img-muscles').attr('src', musclesLink);
    info = gatherWorkoutInfos(workout);
    $('#detailed-instructions').attr('alt', info.name);
    $('.img-muscles').attr('alt', (info.name + ' Muscles'));
    $('#info-workout-type').text(info.type);
    $('#info-workout-focus').text(info.focus);
    $('#info-workout-difficulty').text(info.difficulty);
    $('#workout-description').html(htmlDecode(info.description));
    $('#info-modal').modal();
}

function gatherWorkoutInfos(workout) {
    let info = {};
    let row = $('#' + workout);
    info.description = row.attr('workout-description');
    info.name = row.find('.workout-name strong').text();
    info.type = row.find('.type-col').text();
    info.focus = row.find('.focus-col').text();
    info.difficulty = row.find('.difficulty-col').text();
    return info;
}

$(function() {
    $('#workout-search-area').on('shown.bs.collapse', function() {
        $('.toggle-btn .btn-text').text('Hide Search');
        $('.toggle-btn .btn-icon').addClass('fa-rotate-180');
    });
    $('#workout-search-area').on('hidden.bs.collapse', function() {
        $('.toggle-btn .btn-text').text('Show Search');
        $('.toggle-btn .btn-icon').removeClass('fa-rotate-180');
    });
    if(isMobile()) {
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
        $('#show-details, #preview-frame-mobile img').click(function() {
            let workout = $(this).attr('details-target');
            $('#preview-frame-mobile').modal('hide');
            openInfoModal(workout);
        })
    } else {
        $('.hover-preview').mouseenter(function() {
            let src = getPreviewLink($(this).attr('id'));
            $('#preview-frame-desktop img').attr('src', src);
            $('#preview-frame-desktop').removeClass('d-none');
        });
        $('.hover-preview').mouseleave(function() {
            $('#preview-frame-desktop img').attr('src', '');
            $('#preview-frame-desktop').addClass('d-none');
        });
        $('#workouts-table .workout-name').click(function() {
            let workout = $(this).attr('details-target');
            openInfoModal(workout);
        });
    }
});
