<?php

namespace Kriscpg\Menu\Api\Data;

interface MenuItemInterface
{
    public function getMenuItemId(): int;
    public function setMenuItemId(int $menuItemId);
    public function getMenuId(): int;
    public function setMenuId(int $menuId);
    public function getLabel(): string;
    public function setLabel(string $label);
    public function getMenuItemType(): string;
    public function setMenuItemType(string $name);
    public function getCreatedAt(): string;
    public function setCreatedAt(string $createdAt);
    public function getUpdatedAt(): string;
    public function setUpdatedAt(string $updatedAt);
    public function getIsActive(): bool;
    public function setIsActive(bool $isActive);
    public function getSortOrder(): int;
    public function setSortOrder(int $order);
}
