function esc(id,oldHtml) {
    $(document).ready(function () {
        $("body").keyup(function (event) { // задаем функцию при отпускании после нажатия любой клавиши клавиатуры на элементе
            if (event.which === 27) {
                $('#' + id).html(oldHtml);/*для отображения в броузере передаем новое значение категории в таблицу name*/
            }
        });
    });
}