$(function () {
    $(".acInput").autocomplete({
        source: hint
    })
});
$(function () {
    $(".acInputTag").autocomplete({
        source: tagSearch
    })
});

$('#searchTag').on('keyup', function () {

    var tr, filter, cell, row, i;
    filter = $('#searchTag').val().toLowerCase();
    console.log(filter);
    tr = $("tr");
    for (i = 1; i < tr.length; i++) {
        row = $("table tr").eq(i);
        cell = $("td", row).eq(4);
        if (filter) {
            if (cell.text().toLowerCase().indexOf(filter) > -1) {
                $(tr[i]).show();
            } else {
                $(tr[i]).hide();
            }
        }
    }
});

$('#searchTitle').on('keyup', function () {
    var tr, filter, cell, row, i;
    filter = $('#searchTitle').val().toLowerCase();
    tr = $("tr");
    for (i = 1; i < tr.length; i++) {
        row = $("table tr").eq(i);
        cell = $("td", row).eq(1);
        if (filter) {
            if (cell.text().toLowerCase().indexOf(filter) > -1) {
                $(tr[i]).show();
            } else {
                $(tr[i]).hide();
            }
        }
    }
});







