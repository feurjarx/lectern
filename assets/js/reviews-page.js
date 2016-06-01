/**
 * Created on 01.06.2016.
 */
$(function () {

    var $jRate = $('#jRate');
    $jRate.jRate({
        rating: 1,
        min: 0,
        max: 5,
        minSelected: 1,
        precision: 1,
        strokeWidth: '20px',
        strokeColor: '#34495e',
        onSet: function(rating) {
            $jRate.next('input').val(rating);
        }
    });

    $('#review-poster').on('submit', function (event) {
        event.preventDefault();

        var gRecaptchaResponse = $('[name="g-recaptcha-response"]').val();

        if (gRecaptchaResponse) {

            debugger

            var dataSending = $.extend($(this).serializeObject(), {
                'g-recaptcha-response': gRecaptchaResponse
            });

            var $submitBtn = $(this).find('button[type="submit"]');

            $.ajax({
                url: '/review/new',
                dataType: 'JSON',
                method: 'POST',
                data: dataSending,
                beforeSend: function () {
                    $submitBtn.prop('disabled', true);
                },
                success: function (data) {

                    var notyConf = {
                        text: data['message'],
                        type: data['type'],
                        timeout: 5000
                    };

                    if ('success' === data['type']) {

                        notyConf.animation = {
                            open: 'animated bounceInRight',
                            close: 'animated bounceOutRight'
                        };
                    }

                    notification(notyConf);
                },
                error: function (err) {

                    notification({
                        text: 'Ошибка! <br> Отказ сервера',
                        type: 'error'
                    });

                    console.error(err);
                },
                complete: function () {

                    $submitBtn.prop('disabled', false);
                }
            });

        } else {

            notification({
                text: 'Внимание! <br> Подтведите, что вы не робот',
                type: 'warning'
            });
        }
    });
});