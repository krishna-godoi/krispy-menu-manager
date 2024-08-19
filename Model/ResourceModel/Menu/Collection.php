<?php declare(strict_types=1);

namespace Kriscpg\Menu\Model\ResourceModel\Menu;

use Kriscpg\Menu\Model\Menu;
use Kriscpg\Menu\Model\ResourceModel\Menu as MenuResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            Menu::class,
            MenuResource::class
        );
    }

}
