/**
 * Created on 15.05.2016.
 */

$('#add-plus-modal')
    .on('submit', function (event) {
        event.preventDefault();

        var
            $addPlusModal = $(this),
            $submitButton = $addPlusModal.find('button[type="submit"]')
        ;

        $.ajax({
            url: '/employer/ad/plus',
            type: 'post',
            dataType: 'json',
            data: $addPlusModal.serializeObject(),
            beforeSend: function () {
                $submitButton.prop('disabled', true);
            },
            success: function (data) {

                notification({
                    text: data['message'],
                    type: data['type'],
                    timeout: 5000
                });

                if ('success' === data['type']) {
                    // TODO: append
                    //$('#ads').find('ul').append($('<li>', {
                    //
                    //}));
                    $addPlusModal.modal('hide');
                }
            },
            error: function (err) {

                notification({
                    text: 'Ошибка! Отказ сервера',
                    type: 'error'
                });

                console.error(err);
            },
            complete: function () {
                $submitButton.prop('disabled', false);
            }
        });
    })
    .on('shown.bs.modal', function () {
        $('#ad-name-input').focus();
    })
;