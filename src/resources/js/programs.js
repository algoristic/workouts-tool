function getProgramMediaLink(program) {
    return './media/programs/' + program;
}

function getIntroLink(program) {
    return (getProgramMediaLink(program) + '/intro.jpg');
}

function gatherProgramInfos(program) {
    let info = {};
    let row = $('#' + program);
    info.description = row.attr('program-description');
    info.name = row.find('.program-name strong').text();
    //info.days = row.find('.days-col').text();
    return info;
}

function openInfoModal(program) {
    $('#intro-img').attr('src', '');
    let introLink = getIntroLink(program);
    $('#intro-img').attr('src', introLink);
    let info = gatherProgramInfos(program);
    $('#intro-img').attr('alt', info.name);
    $('#program-description').html(htmlDecode(info.description));
    $('#info-modal').modal();
}

$(function() {
    $('#programs-table .program-name').click(function() {
        let program = $(this).attr('details-target');
        openInfoModal(program);
    });
    $('#programs-table').DataTable({
        ordering: false,
        lengthChange: false,
        stateSave: true
    });
});
