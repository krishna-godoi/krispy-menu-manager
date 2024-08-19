<?php declare(strict_types=1);

namespace Kriscpg\Menu\Service;

use Kriscpg\Menu\Api\Data\MenuItemInterface;
use Kriscpg\Menu\Api\MenuItemRepositoryInterface;
use Kriscpg\Menu\Model\ResourceModel\MenuItem as MenuItemResource;
use Kriscpg\Menu\Model\MenuItemFactory;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Data\Form\FormKey\Validator as FormKeyValidator;

class MenuItemRepository implements MenuItemRepositoryInterface
{
    /**
     * @param MenuItemResource $resource
     * @param MenuItemFactory $factory
     * @param FormKeyValidator $validator
     */
    public function __construct(
        private readonly MenuItemResource $resource,
        private readonly MenuItemFactory $factory,
        private readonly FormKeyValidator $validator,
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
     * @return int
     * @throws LocalizedException
     */
    public function createItem(mixed $data): int
    {
        $item = $this->factory->create();
        $item->setData($data);

        $this->resource->save($item);

        return (int) $item->getId();
    }
}
