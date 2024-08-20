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
     * @return void
     */
    public function setMenuId(int $menuId): void
    {
        $this->setData(self::MENU_ID, $menuId);
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
     * @return void
     */
    public function setName(string $name): void
    {
        $this->setData(self::NAME, $name);
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
     * @return void
     */
    public function setIdentifier(string $identifier): void
    {
        $this->setData(self::IDENTIFIER, $identifier);
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
     * @return void
     */
    public function setCreatedAt(string $createdAt): void
    {
        $this->setData(self::CREATED_AT, $createdAt);
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
     * @return void
     */
    public function setUpdatedAt(string $updatedAt): void
    {
        $this->setData(self::UPDATED_AT, $updatedAt);
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
     * @return void
     */
    public function setIsActive(bool $isActive): void
    {
        $this->setData(self::IS_ACTIVE, $isActive);
    }
}
