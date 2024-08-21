<?php

declare(strict_types=1);

namespace Kriscpg\Menu\Service;

use Kriscpg\Menu\Api\Data\MenuItemInterface;
use Kriscpg\Menu\Api\MenuItemRepositoryInterface;
use Kriscpg\Menu\Model\ResourceModel\MenuItem as MenuItemResource;
use Kriscpg\Menu\Model\MenuItemFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Kriscpg\Menu\Model\ResourceModel\MenuItem\CollectionFactory;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

class MenuItemRepository implements MenuItemRepositoryInterface
{

    /**
     * @param MenuItemResource $resource
     * @param MenuItemFactory $factory
     * @param SearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        private readonly MenuItemResource $resource,
        private readonly MenuItemFactory $factory,
        private readonly SearchResultsInterfaceFactory $searchResultsFactory,
        private readonly CollectionFactory $collectionFactory,
    ) {
    }

    /**
     * Menu item save method
     *
     * @param MenuItemInterface $menuItem
     * @return void
     * @throws AlreadyExistsException
     */
    public function save(MenuItemInterface $menuItem): void
    {
        $this->resource->save($menuItem);
    }

    /**
     * Get menu item by ID
     *
     * @param int $menuItemId
     * @return MenuItemInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $menuItemId): MenuItemInterface
    {
        $menuItem = $this->factory->create();
        $this->resource->load($menuItem, $menuItemId);
        if (!$menuItem->getId()) {
            throw new NoSuchEntityException(
                __('The menu with id "%d" does not exist.', $menuItemId)
            );
        }

        return $menuItem;
    }

    /**
     * Delete menu item
     *
     * @param MenuItemInterface $menuItem
     * @return void
     * @throws \Exception
     */
    public function delete(MenuItemInterface $menuItem): void
    {
        $this->resource->delete($menuItem);
    }

    /**
     * Create menu item
     *
     * @param mixed $data
     * @param int $menuId
     * @return int
     * @throws LocalizedException
     */
    public function createItem(mixed $data, int $menuId): int
    {
        $item = $this->factory->create();
        $item->setData($data)->setMenuId($menuId);

        $this->resource->save($item);

        return (int) $item->getId();
    }

    /**
     * Get list of menu items matching criteria
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchResultsInterface
    {
        $collection = $this->collectionFactory->create();

        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                $condition = $filter->getConditionType() ?: 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }

        $sortOrders = $searchCriteria->getSortOrders();
        if ($sortOrders) {
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }

        $collection->setPageSize($searchCriteria->getPageSize());
        $collection->setCurPage($searchCriteria->getCurrentPage());

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}
