<?php

declare(strict_types=1);

namespace Kriscpg\Menu\Model\ResourceModel\MenuItem;

use Kriscpg\Menu\Model\MenuItem;
use Kriscpg\Menu\Model\ResourceModel\MenuItem as MenuItemResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            MenuItem::class,
            MenuItemResource::class
        );
    }
}
