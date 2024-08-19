<?php declare(strict_types=1);

namespace Kriscpg\Menu\Api;

use Exception;
use Kriscpg\Menu\Api\Data\MenuItemInterface;

interface MenuItemRepositoryInterface
{
    /**
     * Menu item save method
     *
     * @param MenuItemInterface $menuItem
     * @return void
     */
    public function save(MenuItemInterface $menuItem): void;

    /**
     * Get menu item by ID
     *
     * @param int $menuItemId
     * @return MenuItemInterface
     */
    public function getById(int $menuItemId): MenuItemInterface;

    /**
     * Delete menu item
     *
     * @param MenuItemInterface $menuItem
     * @return void
     * @throws Exception
     */
    public function delete(MenuItemInterface $menuItem): void;

    /**
     * Delete menu item
     *
     * @param mixed $data
     * @return int
     */
    public function createItem(mixed $data): int;
}
