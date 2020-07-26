$(".removetime").on("contextmenu", function () {
    var id = $(this).attr("id");
    var idr = id.replace(/[a-z-]/g, '');

    var yes = 'yes';
    var undefined = 'undefined';
    /** Добавим кнопку удалить*/
    if (!$("a").is("#btnRem-" + id)) {
        var html = '<a id="btnNote-' + id + '" class="note" onclick="noteRead(\'' + idr + '\')"><i class="fas fa-pencil-alt text-primary"></i></a>' +
            '<a id="btnYes-' + id + '" class="yes" onclick="confirm(\'' + id + '\',\'' + yes + '\')"><i class="fas fa-check text-success"></i></a>' +
            '<a id="btnNo-' + id + '" class="no" onclick="confirm(\'' + id + '\')"><i class="fas fa-exclamation text-warning"></i></a>' +
            '<a id="btnEsc-' + id + '" class="undefined" onclick="confirm(\'' + id + '\',\'' + undefined + '\')"><i class="fas fa-times text-info"></i></a>' +
            '<a id="btnRem-' + id + '" class="del" onclick="removedСonfirm(\'' + id + '\')"><i class="far fa-trash-alt text-danger"></i></a>';
        $("#" + id).prepend(html);
    }
    /**  Отмена удаления по ESC */

    $(document).ready(function () {
        $("body").keyup(function (event) { // задаем функцию при отпускании после нажатия любой клавиши клавиатуры на элементе
            if (event.which === 27) {
                $("#btnNote-" + id).remove();/*для отображения в броузере передаем новое значение категории в таблицу name*/
                $("#btnYes-" + id).remove();/*для отображения в броузере передаем новое значение категории в таблицу name*/
                $("#btnNo-" + id).remove();
                $("#btnEsc-" + id).remove();
                $("#btnRem-" + id).remove();
            }
        });
    });
});


function noteRemove() {

}

/**
 * Обновить римечание
 */
function noteUpdate() {
    var id = $('#noteId').val();
    var note = $('#noteText').val();
    if (note.length < 2) {
        var html = '<div id="alertNote" class="alert alert-danger ml-3 mr-3" role="alert"><strong class="lead">Ошибка: </strong>Введите текст примечания.</div>';
        $('#infoNote').html(html);
        return;
    }

    $.post('/timeres-adm/updateNote', {id: id, note: note}, function (res) {

        $('#errNote').remove();
        $('#alertNote').remove();
        if (!res[0].success) {
            var html = '<div id="errNote" class="alert alert-danger ml-3 mr-3" role="alert"><strong class="lead">Ошибка: </strong>' + res[0].err + '</div>';
            $('#infoNote').html(html);
            return;
        }

        if ($('button').is('#newNote')) {
            html = '<p><a class="link-note-add" onclick="noteRead(\'' + id + '\')"><i class="fas fa-check-square"></i></a></p>';
            $('#visit-' + id).prepend(html);
        }
        $('#noteTimeRes').fadeOut().modal('hide');
    });

}

/**
 *получаем из БД примечание
 * @param id
 */
function noteRead(id) {
    $.post('/timeres-adm/readNote', {id}, function (res) {
        if (!res[0].success) {
            var html = '<div class="alert alert-danger" role="alert"><strong class="lead">Ошибка: </strong>' + res[0].err + '</div>';
            $('#systeminfo').html(html);
            setTimeout(function () {
                $('#system').fadeOut().modal('hide');
            }, 7000);
            $('#system').fadeIn().modal('show');
            return;
        }

        if (!res[0].note) {
            var buton1 = '<button id="newNote" class="btn btn-outline-success" onclick="noteUpdate()">Создать</button>';
            $('#buttonNote').html(buton1);
            $('#noteId').val(id);
            $('#noteTimeRes').fadeIn().modal('show');
            return;
        }
        var buton = '<button id="delNote" class="btn btn-outline-danger" onclick="noteRemove()">Удалить</button>\n' +
            '<button class="btn btn-outline-success" onclick="noteUpdate()">Изменить</button>';
        $('#buttonNote').html(buton);
        $('#noteId').val(id);
        $('#noteText').val(res[0].note);
        $('#noteTimeRes').fadeIn().modal('show');
    });
}

/**
 * отметим пришел или нет клиент
 * @param id
 * @param yes
 */
function confirm(id, yes, undefined) {
    var action;
    switch (true) {
        case !!yes:
            action = yes;
            break;
        case !!undefined :
            action = undefined;
            break;
        default :
            action = 'no';
    }

    $.post('/timeres-adm/bookingAction', {id: id, action: action}, function (res) {

        if (!res[0].success) {
            var html = '<div class="alert alert-danger" role="alert"><strong class="lead">Ошибка: </strong>' + res[0].err + '</div>';
            $('#systeminfo').html(html);
            setTimeout(function () {
                $('#system').fadeOut().modal('hide');
            }, 7000);
            $('#system').fadeIn().modal('show');
            return;
        }

        if (action === 'no') {
            if ($("#" + id).is(".old")) {
                $("#" + id).attr("class", "old bg-no-des removetime");
            } else {
                $("#" + id).attr("class", "bg-no removetime");
            }
        }
        if (action === yes) {
            if ($("#" + id).is(".old")) {
                $("#" + id).attr("class", "old bg-yes-des removetime");
            } else {
                $("#" + id).attr("class", "bg-yes removetime");
            }
        }
        if (action === 'undefined') {
            if ($("#" + id).is(".old")) {
                $("#" + id).attr("class", "old bg-des removetime");
            } else {
                $("#" + id).attr("class", "bg-ocupado removetime");
            }
        }

    });
}


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
    $('input:checkbox:checked').each(function () {
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
    var data = {
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

        if (!res[0].success) {
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