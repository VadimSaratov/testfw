$(document).ready(function() {
    $('td').on('click', '#smImg', function() {
        $('#bgImg').attr('src', $(this).attr('src'));
        $('#imagemodal').modal('show');
    });
});/**
 * Created by Vadim on 30.01.2018.
 */
