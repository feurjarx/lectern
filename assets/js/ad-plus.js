/**
 * Created on 15.05.2016.
 */

$('#ad-plus-modal')
    .on('submit', function (event) {
        event.preventDefault();

        var
            $addPlusModal = $(this),
            $submitButton = $addPlusModal.find('button[type="submit"]'),
            sendData = $addPlusModal.serializeObject()
        ;


        $.ajax({
            url: '/employer/ad/plus',
            type: 'post',
            dataType: 'json',
            data: sendData,
            beforeSend: function () {
                $submitButton.prop('disabled', true);
            },
            success: function (data) {

                var notyConf = {
                    text: data['message'],
                    type: data['type'],
                    timeout: 5000
                };

                if ('success' === data['type']) {
                    
                    var lastDetailsBlock = $('pre[id^="ad-details"]').get(-1),
                        $adsList = $('#ads').find('ul');

                    if (lastDetailsBlock) {

                        nextDetailsId = parseInt(lastDetailsBlock.id.match(/\d/g).join('')) + 1;

                    } else {

                        $adsList.empty();
                        nextDetailsId = 1;
                    }

                    var $newAd = $('<li>', {
                        href: '#ad-details-' + nextDetailsId,
                        'data-toggle': 'collapse',
                        class: 'col-lg-12 list-group-item ad',
                        html: [
                            $('<div>', {
                                class: 'col-lg-1 col-xs-1 checkbox-block',
                                html: $('<input>', {
                                    type: 'checkbox',
                                    'data-toggle': 'checkbox-x',
                                    'data-three-state': false,
                                    'data-size': 'sm',
                                    'data-ad-id': data['complete_id']
                                })
                            }),
                            $('<div>', {
                                class: 'col-lg-11',
                                html: [
                                    $('<a>', {
                                        class: 'list-group-item-heading',
                                        text: sendData['name'].ucfirst()
                                    }),
                                    $('<pre>', {
                                        id: 'ad-details-' + nextDetailsId,
                                        class: 'list-group-item-text panel-collapse collapse',
                                        text: sendData['details'].ucfirst()
                                    })
                                ]
                            }),
                            $('<span>', {
                                class: 'badge badge-salary pull-right',
                                text: sendData['salary'] ? sendData['salary'] : 'Не указано'
                            })
                        ]
                    });

                    $newAd.find('input[type="checkbox"]').checkboxX();

                    $adsList.append($newAd);

                    $addPlusModal
                        .modal('hide')
                        .get(0).reset()
                    ;

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
                $submitButton.prop('disabled', false);
            }
        });
    })
    .on('shown.bs.modal', function () {
        $('#ad-name-input').focus();
    })
;