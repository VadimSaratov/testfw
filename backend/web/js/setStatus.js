/**
 * Created by Vadim on 08.02.2018.
 */
$(document).ready(function () {
    $('td').on('switchChange.bootstrapSwitch', '#status',function (e,data) {
        var id = $(this).parents("tr:first").attr('data-id');


        $.ajax({
            url: '/admin/banner/status',
            type: 'POST',
            data: {'status': data, 'id': id}
        })
            .done(function (response) {
                console.log(response);
            })
            .fail(function () {
                console.log("error");
            });
        });
});