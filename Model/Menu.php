<?php declare(strict_types=1);

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

    public function getMenuId(): int
    {
        return (int) $this->getData(self::MENU_ID);
    }

    public function setMenuId(int $menuId)
    {
        $this->setData(self::MENU_ID, $menuId);
    }

    public function getName(): string
    {
        return $this->getData(self::NAME);
    }

    public function setName(string $name)
    {
        $this->setData(self::NAME, $name);
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
}
