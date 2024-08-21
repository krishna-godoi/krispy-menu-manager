define([
    'jquery',
    'Magento_Ui/js/form/element/text',
    'Magento_Ui/js/modal/modal',
    'ko'
], function ($, Abstract, modal, ko) {
    'use strict';

    let getHash = (length) => {
        let result = '';
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_=';
        const charactersLength = characters.length;
        let counter = 0;
        while (counter < length) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
            counter += 1;
        }
        return result;
    };

    window.createItem = function (item) {
        const items = window.menuBuilderContext.items;
        const { parent_id } = item;
        let id = Object.values(items).length;

        item.id = id;
        items[id] = item;

        if (parent_id) {
            items[parent_id] = {...items[parent_id], children: [...(items[parent_id].children || []), item.id]}
        }

        $('#menu-builder-items').trigger('itemadded')
    }

    return Abstract.extend({
        initialize: function () {
            if (!window.menuBuilderContext) {
                const key = getHash(8);

                window.menuBuilderContext = {
                    key,
                    items: {}
                }
            }

            this._super();
            return this;
        },

        openModal: function () {
            $("#add-item-modal").modal("openModal");
        },

        refreshItems: function () {
            const items = window.menuBuilderContext.items;
            let queue = Object.values(items).filter((item) => !item.parent_id).map((item) => item.id);

            let builderItems = $('#menu-builder-items');
            builderItems.empty();

            while (queue.length > 0) {
                let len = queue.length;
                let inserted = 0;

                for (let i = 0; i < len; i++, inserted++) {
                    let item = items[queue[i]];
                    if (item.children) {
                        queue.push(...item.children)
                    }

                    const domItem = document.createElement('p');
                    const domContent = document.createTextNode(item.label);
                    domItem.id = item.id;
                    domItem.append(domContent);

                    const insertPoint = item.parent_id ? $(`#${item.parent_id}`) : builderItems;
                    insertPoint.append(domItem);
                }

                queue.splice(0, inserted);
            }

            let $input = $('input[name="items"]');
            $input.val(JSON.stringify(items));
            $input.trigger('change');
        }
    });
});
