<?php declare(strict_types=1);

namespace Kriscpg\Menu\Api;

use Exception;
use Kriscpg\Menu\Api\Data\MenuInterface;

interface MenuRepositoryInterface
{
    /**
     * Menu save method
     *
     * @param MenuInterface $menu
     * @return void
     */
    public function save(MenuInterface $menu): void;

    /**
     * Get menu by ID
     *
     * @param int $menuId
     * @return MenuInterface
     */
    public function getById(int $menuId): MenuInterface;

    /**
     * Delete menu by ID
     *
     * @param MenuInterface $menu
     * @return void
     * @throws Exception
     */
    public function delete(MenuInterface $menu): void;
}
