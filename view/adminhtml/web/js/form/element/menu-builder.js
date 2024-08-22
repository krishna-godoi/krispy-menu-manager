define([
    'jquery',
    'Magento_Ui/js/form/element/text',
    'Magento_Ui/js/modal/modal',
    'ko'
], function ($, Abstract, modal, ko) {
    'use strict';

    window.createItem = function (item) {
        const items = window.menuBuilderContext.items;
        const { parent_id } = item;
        let id = window.menuBuilderContext.idx;

        item.id = id;
        items[id] = item;

        if (parent_id) {
            items[parent_id] = {...items[parent_id], children: [...(items[parent_id].children || []), item.id]}
        }

        window.menuBuilderContext.idx++

        $('#menu-builder-items').trigger('itemadded')
    }

    window.editItem = function (itemId, values) {
        const id = itemId.toString();
        window.menuBuilderContext.items[id] = {
            ...window.menuBuilderContext.items[id],
            ...values
        }
    }

    window.deleteItem = function (itemId) {
        const id = itemId.toString();
        const ctx = window.menuBuilderContext;
        const item = ctx.items[id];

        if (item.children) {
            item.children.forEach(childId => window.deleteItem(childId));
        }

        if (item.parent_id) {
            const parent = ctx.items[item.parent_id];
            parent.children = parent.children.filter(childId => childId.toString() !== id);
        }

        delete ctx.items[id];
        window.refreshItems();
    }


    window.refreshItems = function () {
        const items = window.menuBuilderContext.items;
        let queue = Object.values(items).filter((item) => !item.parent_id).map((item) => item.id);

        let builderItems = $('#menu-builder-items');
        builderItems.empty();

        while (queue.length > 0) {
            let len = queue.length;
            let inserted = 0;

            for (let i = 0; i < len; i++, inserted++) {
                const item = items[queue[i]];
                const hasChildren = !!item.children?.length
                if (hasChildren) {
                    queue.push(...item.children)
                }

                const handle = `<span ${item.target_url ? 'link' : ''}>${item.label}</span>`;

                const contextMenu = `
                        <div class="ctx-menu-container">
                            <button class="ctx-menu-btn" onclick="toggleCtxMenu(${item.id})">...</button>
                            <ul class="item-ctx-menu ctx-id-${item.id}">
                                <li><button onclick="openItemModal(null, ${item.id})" class="action-add-subitem">Add subitem</button></li>
                                <li><button onclick="openItemModal(${item.id}, ${item.parentId})" class="action-edit">Edit</button></li>
                                <li><button onclick="deleteItem(${item.id})" class="action-delete">Delete</button></li>
                            </ul>
                        </div>
                    `;

                const template = hasChildren ? $(`
                        <details id="${item.id}">
                            <summary>${handle}${contextMenu}</summary>
                        </details>
                    `): $(`
                        <div class="item-container" id="${item.id}">${handle}${contextMenu}</div>
                    `);

                const insertPoint = item.parent_id ? $(`#${item.parent_id}`) : builderItems;
                insertPoint.append(template);
            }

            queue.splice(0, inserted);
        }

        let $input = $('input[name="items"]');
        $input.val(JSON.stringify(items));
        $input.trigger('change');
    }

    window.openItemModal = (id, parentId) => {
        const item = window.menuBuilderContext.items[id?.toString()];

        $('#item-label').val(item?.label);
        $('#item-url').val(item?.target_url);
        $('#item-parent').val(parentId?.toString());
        $('#add-item-modal').modal('openModal');
    }

    window.closeItemModal = () => {
        $('#add-item-modal').modal('closeModal');
        $('#item-creation-form').trigger('reset');
    }

    window.toggleCtxMenu = (itemId) => {
        $(`.item-ctx-menu.ctx-id-${itemId}`).toggleClass('open');
    }

    return Abstract.extend({
        initialize: function () {
            if (!window.menuBuilderContext) {
                window.menuBuilderContext = {
                    idx: 0,
                    items: {}
                }
            }

            this._super();
            return this;
        },
    });
});
