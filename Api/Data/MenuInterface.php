<?php declare(strict_types=1);

namespace Kriscpg\Menu\Api\Data;

interface MenuInterface
{
    public function getMenuId(): int;
    public function setMenuId(int $menuId);
    public function getName(): string;
    public function setName(string $name);
    public function getIdentifier(): string;
    public function setIdentifier(string $identifier);
    public function getCreatedAt(): string;
    public function setCreatedAt(string $createdAt);
    public function getUpdatedAt(): string;
    public function setUpdatedAt(string $updatedAt);
    public function getIsActive(): bool;
    public function setIsActive(bool $isActive);
}
