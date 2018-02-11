/**
 * Created by Vadim on 08.02.2018.
 */
(function() {

    var app = {

        initialize : function () {
            this.setUpListeners();
        },

        setUpListeners: function () {
            $('#modalForm').on('submit',app.submitForm);
            $('#modalForm').on('click', 'input',app.removeError);
        },

        submitForm: function (e) {
            e.preventDefault();
            var form = $(this),
                submitBtn = form.find('button[type="submit"]');

            if (app.validateForm(form)  === false) return false;

            submitBtn.attr('disabled', 'disabled');

            var formData = new FormData(form[0]);
            formData.append( 'image', $('#imgInp')[0].files[0]);

            $.ajax({
                url:'/admin/banner/add/',
                type:'POST',
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
            })
                .done(function (response) {
                    if (response === 'OK'){
                        var res = "<div class='bg-success'>Баннер добавлен</div>";
                        form.html(res);
                    }else {
                        var errors = $.parseJSON(JSON.stringify(response));
                        $.each(errors, function (name, msg ) {
                            var input = form.find('input[name="' + name + '"]'),
                            formGroup = input.parents('.form-group'),
                            textError = msg;

                            formGroup.addClass('has-error').removeClass('has-success');
                            input.tooltip({
                                trigger: 'manual',
                                placement: 'top',
                                title: textError
                            }).tooltip('show');
                        });
                    }
                })
                .always(function () {
                    submitBtn.removeAttr('disabled');
                });

        },
        validateForm:function (form) {
            var inputs = form.find('input');
            var valid = true;
            inputs.tooltip('destroy');
            $.each(inputs, function (index, val) {
                var input = $(val),
                    value = input.val(),
                    formGroup = input.parents('.form-group');
                    textError = formGroup.find("span.hide-error").text();

                if (value.length === 0){
                    formGroup.addClass('has-error').removeClass('has-success');
                    input.tooltip({
                        trigger: 'manual',
                        placement: 'top',
                        title: textError
                    }).tooltip('show');
                    valid = false;
                }else {
                    formGroup.addClass('has-success').removeClass('has-error');
                }
            });

            return valid;
        },
        removeError: function () {
            $(this).tooltip('destroy').parents('.form-group').removeClass('has-error');
        }
    };

    app.initialize();

}());