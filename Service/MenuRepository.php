<?php declare(strict_types=1);

namespace Kriscpg\Menu\Service;

use Kriscpg\Menu\Api\Data\MenuInterface;
use Kriscpg\Menu\Api\MenuRepositoryInterface;
use Kriscpg\Menu\Model\ResourceModel\Menu as MenuResource;
use Kriscpg\Menu\Model\MenuFactory;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\NoSuchEntityException;

class MenuRepository implements MenuRepositoryInterface
{
    /**
     * @param MenuResource $resource
     * @param MenuFactory $factory
     */
    public function __construct(
        private readonly MenuResource $resource,
        private readonly MenuFactory $factory,
    ) {
    }

    /**
     * Menu save method
     *
     * @param MenuInterface $menu
     * @return void
     * @throws AlreadyExistsException
     */
    public function save(MenuInterface $menu): void
    {
        $this->resource->save($menu);
    }

    /**
     * Get menu by ID
     *
     * @param int $menuId
     * @return MenuInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $menuId): MenuInterface
    {
        $menu = $this->factory->create();
        $this->resource->load($menu, $menuId);
        if (!$menu->getId()) {
            throw new NoSuchEntityException(
                __('The menu with id "%d" does not exist.', $menuId)
            );
        }

        return $menu;
    }

    /**
     * Delete menu
     *
     * @param MenuInterface $menu
     * @return void
     * @throws \Exception
     */
    public function delete(MenuInterface $menu): void
    {
        $this->resource->delete($menu);
    }
}
