$(".removetime").on("contextmenu", function () {
    var id = $(this).attr("id");
    /** Добавим кнопку удалить*/
    var html = '<button id="btnRem-' + id + '" class="btn btn-link del" onclick="removedСonfirm(\'' + id + '\')"><i class="far fa-trash-alt text-danger"></i></button>';
    $("#" + id).prepend(html);

    /**  Отмена удаления по ESC */

    $(document).ready(function () {
        $("body").keyup(function (event) { // задаем функцию при отпускании после нажатия любой клавиши клавиатуры на элементе
            if (event.which === 27) {
                $("#btnRem-" + id).remove();/*для отображения в броузере передаем новое значение категории в таблицу name*/
            }
        });
    });
});


function removedСonfirm(id) {
    var html = '<div class="col-12"><p class="alert alert-info">Вы действительно хотите удалить <span class="lead"><strong>эту встречу</strong></span>?</p></div>' +
        '<div class="col-12">' +
        '<button type="button" class="btn badge-success btn-block" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">НЕТ</span></button>' +
        '<button id="update_sitemail" type="button" class="btn badge-danger btn-block" onclick="removedTime(\'' + id + '\')">ДА </button>' +
        '</div>';
    $('#removedinfo').html(html);
    $('#removed').fadeIn().modal('show');
}


function removedTime(id) {
    $('#removed').fadeIn().modal('hide');
    id = id.replace(/[a-z-]/g, '');
    $.post('/timeres-adm/removedTime', {id: id}, function (res) {
        if (!res[0].success) {
            var html = '<div class="alert alert-danger" role="alert"><strong class="lead">Ошибка: </strong>' + res[0].err + '</div>';
            $('#systeminfo').html(html);
            setTimeout(function () {
                $('#system').fadeOut().modal('hide');
            }, 7000);
            $('#system').fadeIn().modal('show');
            return;
        }
        $("#visit-" + id).remove();

    })

}

function editTimeSet() {

    var minTime = $('#min-time').val().trim().replace(/<[^>]+>/g, '');
    var maxTime = $('#max-time').val().trim().replace(/<[^>]+>/g, '');
    var lunchStart = $('#lunch-start').val().trim().replace(/<[^>]+>/g, '');
    var lunchFinish = $('#lunch-finish').val().trim().replace(/<[^>]+>/g, '');
    var step = $('#step').val().trim().replace(/<[^>]+>/g, '');
    var disabledDates = $('#disabled-dates').val().trim().replace(/<[^>]+>/g, '');
    var checkboxes = [];
    $('input:checkbox:checked').each(function(){
        //добавляем значение каждого флажка в этот массив
        checkboxes.push(this.value);
    });
    /*объединяем массив в строку с разделителем-запятой. Но лучше подобные вещи хранить в массиве. Для наглядности - вывод в консоль.*/
    var desabledWeekDays = checkboxes.join(',');
    var day1 = $('#day-1').val().trim().replace(/<[^>]+>/g, '');
    var day2 = $('#day-2').val().trim().replace(/<[^>]+>/g, '');
    var day3 = $('#day-3').val().trim().replace(/<[^>]+>/g, '');
    var day4 = $('#day-4').val().trim().replace(/<[^>]+>/g, '');
    var day5 = $('#day-5').val().trim().replace(/<[^>]+>/g, '');
    var day6 = $('#day-6').val().trim().replace(/<[^>]+>/g, '');
    var day7 = $('#day-7').val().trim().replace(/<[^>]+>/g, '');
    var data ={
        minTime: minTime,
        maxTime: maxTime,
        lunchStart: lunchStart,
        lunchFinish: lunchFinish,
        step: step,
        disabledDates: disabledDates,
        desabledWeekDays: desabledWeekDays,
        day1: day1,
        day2: day2,
        day3: day3,
        day4: day4,
        day5: day5,
        day6: day6,
        day7: day7
    };

    $.post('/timeres-adm/editSettingTime', data, function (res) {

        if (!res[0].success){
            var html = '<div class="alert alert-danger" role="alert"><strong class="lead">Ошибка: </strong>' + res[0].err + '</div>';
            $('#systeminfo').html(html);
            setTimeout(function () {
                $('#system').fadeOut().modal('hide');
            }, 7000);
            $('#system').fadeIn().modal('show');
            return;
        }
        var html = '<div class="alert alert-success text-center" role="alert"><strong class="lead">Изменения внесены!</strong></div>';
        $('#systeminfo').html(html);
        setTimeout(function () {
            $('#system').fadeOut().modal('hide');
        }, 7000);
        $('#system').fadeIn().modal('show');
        return;
    });
}