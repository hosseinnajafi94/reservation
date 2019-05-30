$(function () {
    $("#print").click(function () {
        printContent('invoice');
    });
    $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
            $('#back-to-top').fadeIn();
        } else {
            $('#back-to-top').fadeOut();

        }
    });
    $('#back-to-top').click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 400);
        return false;
    });
    //$('#back-to-top').tooltip('show');
    $("#login_date, #exit_date").datepicker({
        changeMonth: true,
        changeYear: true ,
        //yearRange: '-105:-0',
        //defaultDate: null,
        //showOtherMonths: true,
        //selectOtherMonths: true,
        isRTL: true,
        dateFormat: "yy/mm/dd"
    });
    $("#tracking_login_date").datepicker({
        changeMonth: true,
        changeYear: true ,
        //yearRange: '-105:-0',
        //showOtherMonths: true,
        //selectOtherMonths: true,
        isRTL: true,
        dateFormat: "yy/mm/dd"
    });
    hideLoading();
});
function hideLoading() {
    $('#box').delay(100).fadeOut('fast');
};
function printContent(el) {
    var restorepage = $('body').html();
    var printcontent = $('#' + el).clone();
    $('body').empty().html(printcontent);
    window.print();
    $('body').html(restorepage);
}