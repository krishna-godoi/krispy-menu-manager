<?php

declare(strict_types=1);

namespace Kriscpg\Menu\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class MenuItem extends AbstractDb
{
    private const string TABLE_NAME = 'menu_block_item';
    private const string FIELD_NAME = 'menu_item_id';

    protected function _construct()
    {
        $this->_init(self::TABLE_NAME, self::FIELD_NAME);
    }
}
