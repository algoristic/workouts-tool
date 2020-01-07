function isMobile() {
    return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
}

function load() {
    $('#loader').removeClass('d-none');
}

function ready() {
    $('#loader').addClass('d-none');
}

function htmlDecode(input) {
  var doc = new DOMParser().parseFromString(input, "text/html");
  return doc.documentElement.textContent;
}

$(function() {
    $('.nav-pills a').click(function() {
        let href = $(this).attr('href');
        let target = href.substring(1, href.length);
        requestParams.set('page', target);
    });
});
