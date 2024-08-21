<?php

declare(strict_types=1);

namespace Kriscpg\Menu\Model;

use Kriscpg\Menu\Api\Data\MenuInterface;
use Magento\Framework\Model\AbstractModel;
use Kriscpg\Menu\Model\ResourceModel\Menu as MenuResource;

class Menu extends AbstractModel implements MenuInterface
{
    private const string MENU_ID = 'menu_id';
    private const string NAME = 'name';
    private const string IDENTIFIER = 'identifier';
    private const string CREATED_AT = 'created_at';
    private const string UPDATED_AT = 'updated_at';
    private const string IS_ACTIVE = 'is_active';

    protected function _construct()
    {
        $this->_idFieldName = self::MENU_ID;
        $this->_init(MenuResource::class);
    }

    /**
     * Get Menu ID
     *
     * @return int
     */
    public function getMenuId(): int
    {
        return (int) $this->getData(self::MENU_ID);
    }

    /**
     * Set Menu ID
     *
     * @param int $menuId
     * @return Menu
     */
    public function setMenuId(int $menuId): Menu
    {
        $this->setData(self::MENU_ID, $menuId);
        return $this;
    }

    /**
     * Get menu name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->getData(self::NAME);
    }

    /**
     * Set menu name
     *
     * @param string $name
     * @return Menu
     */
    public function setName(string $name): Menu
    {
        $this->setData(self::NAME, $name);
        return $this;
    }

    /**
     * Get menu identifier
     *
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->getData(self::IDENTIFIER);
    }

    /**
     * Set menu identifier
     *
     * @param string $identifier
     * @return Menu
     */
    public function setIdentifier(string $identifier): Menu
    {
        $this->setData(self::IDENTIFIER, $identifier);
        return $this;
    }

    /**
     * Get menu creation time
     *
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Set menu created time
     *
     * @param string $createdAt
     * @return Menu
     */
    public function setCreatedAt(string $createdAt): Menu
    {
        $this->setData(self::CREATED_AT, $createdAt);
        return $this;
    }

    /**
     * Get menu update time
     *
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * Set menu update time
     *
     * @param string $updatedAt
     * @return Menu
     */
    public function setUpdatedAt(string $updatedAt): Menu
    {
        $this->setData(self::UPDATED_AT, $updatedAt);
        return $this;
    }

    /**
     * Get menu is_active
     *
     * @return bool
     */
    public function getIsActive(): bool
    {
        return (bool) $this->getData(self::IS_ACTIVE);
    }

    /**
     * Set menu is_active
     *
     * @param bool $isActive
     * @return Menu
     */
    public function setIsActive(bool $isActive): Menu
    {
        $this->setData(self::IS_ACTIVE, $isActive);
        return $this;
    }
}
