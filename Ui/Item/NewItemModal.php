<?php

namespace Kriscpg\Menu\Ui\Item;

use Magento\Backend\Block\Template\Context;

class NewItemModal extends \Magento\Framework\View\Element\Template
{
    private const string NEW_ITEM_URL = 'kriscpg_menu/item/new';

    public function __construct(
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    public function getCustomData()
    {
        return 'This is custom data';
    }

    public function getFormAction()
    {
        return $this->getUrl(self::NEW_ITEM_URL);
    }
}
