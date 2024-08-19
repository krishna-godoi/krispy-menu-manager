define([
    'jquery',
    'Magento_Ui/js/form/element/abstract',
    'Magento_Ui/js/modal/modal',
    'ko'
], function ($, Abstract, modal, ko) {
    'use strict';

    let getHash = (length) => {
        let result = '';
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        const charactersLength = characters.length;
        let counter = 0;
        while (counter < length) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
            counter += 1;
        }
        return result;
    };

    return Abstract.extend({
        initialize: function () {
            this.builderKey = ko.observable(getHash(64));
            this._super();
            return this;
        },

        openModal: function () {
            $("#add-item-modal").modal("openModal");
        },
    });
});
