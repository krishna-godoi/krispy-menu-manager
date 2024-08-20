<?php

declare(strict_types=1);

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

    /**
     * Get menu item ID
     *
     * @return int
     */
    public function getMenuItemId(): int
    {
        return (int) $this->getData(self::MENU_ITEM_ID);
    }

    /**
     * Set menu item ID
     *
     * @param int $menuItemId
     * @return void
     */
    public function setMenuItemId(int $menuItemId): void
    {
        $this->setData(self::MENU_ITEM_ID, $menuItemId);
    }

    /**
     * Get menu ID
     *
     * @return int
     */
    public function getMenuId(): int
    {
        return (int) $this->getData(self::MENU_ID);
    }

    /**
     * Set menu ID
     *
     * @param int $menuId
     * @return void
     */
    public function setMenuId(int $menuId): void
    {
        $this->setData(self::MENU_ID, $menuId);
    }

    /**
     * Get menu item label
     *
     * @return string
     */
    public function getLabel(): string
    {
        return $this->getData(self::LABEL);
    }

    /**
     * Set menu item label
     *
     * @param string $label
     * @return void
     */
    public function setLabel(string $label): void
    {
        $this->setData(self::LABEL, $label);
    }

    /**
     * Get menu item type
     *
     * @return string
     */
    public function getMenuItemType(): string
    {
        return $this->getData(self::MENU_ITEM_TYPE);
    }

    /**
     * Set menu item type
     *
     * @param string $name
     * @return void
     */
    public function setMenuItemType(string $name): void
    {
        $this->setData(self::MENU_ITEM_TYPE, $name);
    }

    /**
     * Get menu item identifier
     *
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->getData(self::IDENTIFIER);
    }

    /**
     * Set menu item identifier
     *
     * @param string $identifier
     * @return void
     */
    public function setIdentifier(string $identifier): void
    {
        $this->setData(self::IDENTIFIER, $identifier);
    }

    /**
     * Get menu item creation time
     *
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Set menu item creation time
     *
     * @param string $createdAt
     * @return void
     */
    public function setCreatedAt(string $createdAt): void
    {
        $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * Get menu item updated time
     *
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     *  Set menu item updated time
     *
     * @param string $updatedAt
     * @return void
     */
    public function setUpdatedAt(string $updatedAt): void
    {
        $this->setData(self::UPDATED_AT, $updatedAt);
    }

    /**
     * Get menu item is_active
     *
     * @return bool
     */
    public function getIsActive(): bool
    {
        return (bool) $this->getData(self::IS_ACTIVE);
    }

    /**
     * Set menu item is_active
     *
     * @param bool $isActive
     * @return void
     */
    public function setIsActive(bool $isActive): void
    {
        $this->setData(self::IS_ACTIVE, $isActive);
    }

    /**
     * Get menu item sort order
     *
     * @return int
     */
    public function getSortOrder(): int
    {
        return (int) $this->getData(self::SORT_ORDER);
    }

    /**
     * Set menu item sort order
     *
     * @param int $order
     * @return void
     */
    public function setSortOrder(int $order): void
    {
        $this->setData(self::SORT_ORDER, $order);
    }
}
