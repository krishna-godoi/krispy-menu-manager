<?php

declare(strict_types=1);

namespace Kriscpg\Menu\Api;

use Exception;
use Kriscpg\Menu\Api\Data\MenuItemInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;

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
     * Get list of menu items
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchResultsInterface;

    /**
     * Delete menu item
     *
     * @param MenuItemInterface $menuItem
     * @return void
     * @throws Exception
     */
    public function delete(MenuItemInterface $menuItem): void;

    /**
     * Create menu item
     *
     * @param mixed $data
     * @param int $menuId
     * @return int
     */
    public function createItem(mixed $data, int $menuId): int;
}
