/**
 * Created on 15.05.2016.
 */
function notification(options) {
    noty($.extend({}, {
        template: $('<div>', {
            class: 'noty_message',
            html: [
                $('<strong>', {
                    class: 'noty_text'
                }),
                $('<div>', {
                    class: 'noty_close'
                })
            ]
        }),
        layout: 'topRight',
        closeWith: ['click'],
        timeout: 2000,
        animation: {
            open: 'animated wobble',
            close: 'animated flipOutY'
        }
    }, options));
}

String.prototype.ucfirst = function()
{
    return this.charAt(0).toUpperCase() + this.substr(1);
};