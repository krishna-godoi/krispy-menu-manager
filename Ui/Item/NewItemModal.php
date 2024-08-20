<?php

declare(strict_types=1);

namespace Kriscpg\Menu\Ui\Item;

use Magento\Backend\Block\Template\Context;
use Magento\Framework\View\Element\Template;

class NewItemModal extends Template
{
    private const string NEW_ITEM_URL = 'kriscpg_menu/item/new';

    /**
     * Get item modal form action
     *
     * @return string
     */
    public function getFormAction(): string
    {
        return $this->getUrl(self::NEW_ITEM_URL);
    }
}
