function getProgramMediaLink(program) {
    return './media/programs/' + program;
}

function getIntroLink(program) {
    return (getProgramMediaLink(program) + '/intro.jpg');
}

function getDayOverview(program, day) {
    return (getProgramMediaLink(program) + '/day-' + day + '.jpg');
}

function gatherProgramInfos(program) {
    let info = {};
    let row = $('#' + program);
    info.id = program;
    info.description = row.attr('program-description');
    info.name = row.find('.program-name strong').text();
    let days = row.find('.days-col').text();
    info.days = parseInt(days);
    info.src = (day) => {
        return getDayOverview(program, day);
    };
    return info;
}

function openInfoModal(program) {
    let info = gatherProgramInfos(program);
    $('#program-description').html(htmlDecode(info.description));
    buildOverviewNav(program, 1);
    $('#info-modal').modal();
}

function buildOverviewNav(program, day) {
    $('#days-overview img').addClass('loading');
    let info = gatherProgramInfos(program);
    if(day == 1) {
        $('#go-back').prop('disabled', true);
        $('#go-back').attr('preview-target', '');
    } else {
        $('#go-back').prop('disabled', false);
        $('#go-back').attr('preview-target', (day - 1));
    }
    let src = getDayOverview(info.id, day);
    $('#days-overview img').attr('preview-program', info.id);
    $('#days-overview img').attr('src', src);
    $('#days-overview img').attr('alt', ('Preview: Day ' + day));
    $('#days-overview img').removeClass('loading');
    if(day == info.days) {
        $('#go-forward').prop('disabled', true);
        $('#go-forward').attr('preview-target', '');
    } else {
        $('#go-forward').prop('disabled', false);
        $('#go-forward').attr('preview-target', (day + 1));
    }
}

$(function() {
    $('#go-back, #go-forward').click(function() {
        let program = $('#days-overview img').attr('preview-program');
        let day = $(this).attr('preview-target');
        day = parseInt(day);
        buildOverviewNav(program, day);
    });
    if(!isMobile()) {
        $('.hover-preview').mouseenter(function() {
            let src = getIntroLink($(this).attr('id'));
            $('#preview-frame-desktop img').attr('src', src);
            $('#preview-frame-desktop').removeClass('d-none');
        });
        $('.hover-preview').mouseleave(function() {
            $('#preview-frame-desktop img').attr('src', '');
            $('#preview-frame-desktop').addClass('d-none');
        });
    }
    $('#programs-table .program-name').click(function() {
        let program = $(this).attr('details-target');
        openInfoModal(program);
    });
});
