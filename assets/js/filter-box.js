/**
 * Created on 31.05.2016.
 */

$(function () {

    $('#sphere-select').on('changed.bs.select', function () {

        var scrollbox = $('.scrollbox').data('scrollbox');

        scrollbox.params.filters[$(this).attr('name')] = $(this).val();

        scrollbox.$scrollbox.empty();

        scrollbox.listen();
        scrollbox.load();

    })
});