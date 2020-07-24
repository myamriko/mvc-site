function timeReserv() {
    var timeDate = $('#datedye').val().trim().replace(/<[^>]+>/g, '');
    var name = $('#nameTimeReservation').val().trim().replace(/<[^>]+>/g, '');
    var phone = $('#phoneTimeReservation').val().trim().replace(/<[^>]+>/g, '');

    switch (true) {
        case !timeDate.length:
            var html = '<div class="alert alert-danger" role="alert"><strong> Оберіть, будь ласка, день.</strong></div>';
            $('#systeminfo').html(html);
            setTimeout(function () {
                $('#system').fadeOut().modal('hide');
            }, 7000);
            $('#system').fadeIn().modal('show');
            return;

        case timeDate.length == 11:
            var html = '<div class="alert alert-danger" role="alert"><strong> Оберіть, будь ласка, час.</strong></div>';
            $('#systeminfo').html(html);
            setTimeout(function () {
                $('#system').fadeOut().modal('hide');
            }, 7000);
            $('#system').fadeIn().modal('show');
            return;

        case !name.length:
            var html = '<div class="alert alert-danger" role="alert"><strong> Вкажіть, будь ласка, ім\'я</strong></div>';
            $('#systeminfo').html(html);
            setTimeout(function () {
                $('#system').fadeOut().modal('hide');
            }, 7000);
            $('#system').fadeIn().modal('show');
            return;
    }

    $.post('timeres/booking',{timeDate: timeDate, name: name, phone: phone},function (res) {
        console.log(res);
        if (!res[0].success){
            var html = '<div class="alert alert-danger" role="alert"><strong> '+res[0].err+'</strong></div>';
            $('#systeminfo').html(html);
            setTimeout(function () {
                $('#system').fadeOut().modal('hide');
            }, 10000);
            $('#system').fadeIn().modal('show');
            return;
        }
        $('#datedye').val('');
        $('#nameTimeReservation').val('');
        $('#phoneTimeReservation').val('');
        var html = '<div class="alert alert-success" role="alert"><strong> Зустріч призначено. Ми залюбки допоможемо Вам.</strong></div>';
        $('#systeminfo').html(html);
        setTimeout(function () {
            $('#system').fadeOut().modal('hide');
        }, 7000);
        $('#system').fadeIn().modal('show');

    });
}


/** настройка виджета дата время*/
$.datetimepicker.setLocale('uk');

jQuery('#datedye').datetimepicker({
    inline: true,
    yearStart: [$.datepicker.formatDate('yy', new Date())],
    yearEnd: [$.datepicker.formatDate('yy', new Date())],
    dayOfWeekStart: [1],
    disabledWeekDays: disabledWeekDays,
    disabledDates: disabledDates,
    defaultSelect: false,
    formatDate: 'd.m.Y',
    minDate: minDate,
    format: 'j n.Y N',
    minTime: minTime,
    maxTime: maxTime,
    step: step
});

$('#datedye').change(function () {
    var day = $('#datedye').val();

    $.post('timeres/callday', {day: day, minTime: minTime}, function (res) {

        $('#datedye').datetimepicker('setOptions', {
            format: 'j n.Y H:i N',
            allowTimes: res[0].allowTimes
        });

        switch (true) {
            case !!res[0].allowMinTimes:
                $('#datedye').datetimepicker('setOptions', {
                    minTime: res[0].allowMinTimes
                });
                break;
            default :
                $('#datedye').datetimepicker('setOptions', {
                    minTime: minTime
                });
                break;
        }
    });
});
/** настройка виджета дата время*/
