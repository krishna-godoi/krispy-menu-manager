<?php declare(strict_types=1);

namespace Kriscpg\Menu\Model;

use Kriscpg\Menu\Api\Data\MenuItemInterface;
use Magento\Framework\Model\AbstractModel;
use Kriscpg\Menu\Model\ResourceModel\MenuItem as MenuItemResource;

class MenuItem extends AbstractModel implements MenuItemInterface
{
    private const string MENU_ITEM_ID = 'menu_item_id';
    private const string MENU_ID = 'menu_id';
    private const string LABEL = 'label';
    private const string MENU_ITEM_TYPE = 'menu_item_type';
    private const string IDENTIFIER = 'identifier';
    private const string CREATED_AT = 'created_at';
    private const string UPDATED_AT = 'updated_at';
    private const string IS_ACTIVE = 'is_active';
    private const string SORT_ORDER = 'sort_order';

    protected function _construct()
    {
        $this->_idFieldName = self::MENU_ITEM_ID;
        $this->_init(MenuItemResource::class);
    }

    public function getMenuItemId(): int
    {
        return (int) $this->getData(self::MENU_ITEM_ID);
    }

    public function setMenuItemId(int $menuItemId)
    {
        $this->setData(self::MENU_ITEM_ID, $menuItemId);
    }

    public function getMenuId(): int
    {
        return (int) $this->getData(self::MENU_ID);
    }

    public function setMenuId(int $menuId)
    {
        $this->setData(self::MENU_ID, $menuId);
    }

    public function getLabel(): string
    {
        return $this->getData(self::LABEL);
    }

    public function setLabel(string $label)
    {
        $this->setData(self::LABEL, $label);
    }

    public function getMenuItemType(): string
    {
        return $this->getData(self::MENU_ITEM_TYPE);
    }

    public function setMenuItemType(string $name)
    {
        $this->setData(self::MENU_ITEM_TYPE, $name);
    }

    public function getIdentifier(): string
    {
        return $this->getData(self::IDENTIFIER);
    }

    public function setIdentifier(string $identifier)
    {
        $this->setData(self::IDENTIFIER, $identifier);
    }

    public function getCreatedAt(): string
    {
        return $this->getData(self::CREATED_AT);
    }

    public function setCreatedAt(string $createdAt)
    {
        $this->setData(self::CREATED_AT, $createdAt);
    }

    public function getUpdatedAt(): string
    {
        return $this->getData(self::UPDATED_AT);
    }

    public function setUpdatedAt(string $updatedAt)
    {
        $this->setData(self::UPDATED_AT, $updatedAt);
    }

    public function getIsActive(): bool
    {
        return (bool) $this->getData(self::IS_ACTIVE);
    }

    public function setIsActive(bool $isActive)
    {
        $this->setData(self::IS_ACTIVE, $isActive);
    }

    public function getSortOrder(): int
    {
        return (int) $this->getData(self::SORT_ORDER);
    }

    public function setSortOrder(int $order)
    {
        $this->setData(self::SORT_ORDER, $order);
    }
}
