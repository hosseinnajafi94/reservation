/* global group, IndexCompleteUrl */

$(function () {
    if (window.location.hash.toString() === '#tab2') {
        $('[href="#tab2"]').trigger('click');
    }
    var login_date = null;
    var exit_date = null;
    $('#Search').click(function () {
        showLoading();
        $('#error-message').css('display', 'none').html('');
        login_date = $('#login_date').val();
        exit_date = $('#exit_date').val();
        $.ajax({
            type: 'post',
            dataType: 'json',
            data: {
                type: 'get list',
                date1: login_date,
                date2: exit_date
            },
            success: function (result) {
                if (!result.done) {
                    var message = '';
                    $.each(result.messages, function (key, value) {
                        message += value + '<br/>';
                    });
                    $('#error-message').html(message).css('display', 'block');
                    $('#tableslist').html('');
                    $('#tableslist').addClass('hidden');
                    return;
                }
                var trs = '';
                if (result.data.length) {
                    $.each(result.data, function (index, row) {
                        var tr = '';
                        tr += '<div class="viewstyle">';
                        tr += '  <div class="content">';
                        tr += '    <h2>' + row.name1 + '</h2>';
                        tr += '    <p>تعداد تخت ' + row.valint3 + '</p>';
                        tr += '    <p>حداکثر ظرفیت ' + row.valint4 + '</p>';
                        tr += '    ' + (row.name3 ? '<h4>' + row.name3 + '</h4>' : '');
                        tr += '    <h5>هزینه هر شب اقامت ' + row.valint1.format() + ' تومان</h5>';
                        tr += '    <div class="row">';
                        tr += '      <div class="col-md-4 col-sm-12 col-xs-12">';
                        tr += '	       <div class="form-group">';
                        tr += '          <lable>&nbsp;</lable>';
                        tr += '          <a class="btn btn-block btn-success Select" data-id="' + row.id + '">انتخاب</a>';
                        tr += '        </div>';
                        tr += '      </div>';
                        tr += '    </div>';
                        tr += '  </div>';
                        tr += '</div>';
                        trs += tr;
                    });
                } else {
                    trs += '<div class="alert alert-warning">اتاق خالی یافت نشد!</div>';
                }
                $('#tableslist').html(trs);
                $('#tableslist').removeClass('hidden');
            },
            complete: function () {
                hideLoading();
            }
        });
    });
    $(document).on('click', '.Select', function () {
        var id = $(this).attr('data-id');
        $('#error-message').css('display', 'none').html('');
        showLoading();
        $.ajax({
            type: 'post',
            dataType: 'json',
            data: {
                type: 'validate',
                id: id,
                date1: login_date,
                date2: exit_date
            },
            success: function (result) {
                if (!result.done) {
                    var message = '';
                    $.each(result.messages, function (key, value) {
                        message += value + '<br/>';
                    });
                    $('#error-message').html(message).css('display', 'block');
                    return;
                }
                $('#form-info')
                        .append('<input type="hidden" name="id" value="' + id + '"/>')
                        .append('<input type="hidden" name="date1" value="' + login_date + '"/>')
                        .append('<input type="hidden" name="date2" value="' + exit_date + '"/>')
                        .submit();
            },
            complete: function () {
                hideLoading();
            }
        });
    });
    $('#Tracking').click(function () {
        var code_meli = $('#tracking_code_meli').val();
        var login_date = $('#tracking_login_date').val();
        $('#error-message2').css('display', 'none').html('');
        showLoading();
        $.ajax({
            type: 'post',
            dataType: 'json',
            data: {
                type: 'tracking',
                name1: code_meli,
                date1: login_date
            },
            success: function (result) {
                if (!result.done) {
                    var message = '';
                    $.each(result.messages, function (key, value) {
                        message += value + '<br/>';
                    });
                    $('#error-message2').html(message).css('display', 'block');
                    return;
                }
                $('#pay-form')
                        .append('<input type="hidden" name="t" value="' + result.data.t + '"/>')
                        .append('<input type="hidden" name="n" value="' + result.data.n + '"/>')
                        .submit();
            },
            complete: function () {
                hideLoading();
            }
        });
    });
});
function showLoading() {
    $('#box').show();
}
function hideLoading() {
    $('#box').hide();
}
function getParameterByName(name, url) {
    if (!url)
        url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)");
    var results = regex.exec(url);
    if (!results)
        return null;
    if (!results[2])
        return "";
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}
Number.prototype.format = function (n, x) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
};