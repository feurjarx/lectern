/**
 * Created on 15.05.2016.
 */
function notification(options) {
    noty($.extend({}, {
        layout: 'topRight',
        closeWith: ['click', 'hover'],
        timeout: 2000,
        animation: {
            open: 'animated wobble',
            close: 'animated flipOutY'
        }
    }, options));
}