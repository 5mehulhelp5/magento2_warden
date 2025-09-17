define([
    'jquery',
    'Magento_Ui/js/modal/modal'
], function ($, modal) {
    'use strict';

    return function (settings) {
        const content = settings.content,
            timeout = settings.timeout;
        const options = {
            type: 'popup',
            responsive: true,
            autoOpen: true,
        };

        setTimeout( function() {
            $('<div />').html(content).modal(options);
        }, timeout * 1000);
    }
})
