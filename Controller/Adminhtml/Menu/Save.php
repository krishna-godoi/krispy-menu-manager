<?php

declare(strict_types=1);

namespace Kriscpg\Menu\Controller\Adminhtml\Menu;

use Kriscpg\Menu\Api\MenuItemRepositoryInterface;
use Kriscpg\Menu\Api\MenuRepositoryInterface;
use Kriscpg\Menu\Model\MenuFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends Action
{
    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param MenuFactory $menuFactory
     * @param MenuRepositoryInterface $menuRepository
     * @param MenuItemRepositoryInterface $menuItemRepository
     */
    public function __construct(
        Context                                      $context,
        private readonly DataPersistorInterface      $dataPersistor,
        private readonly MenuFactory                 $menuFactory,
        private readonly MenuRepositoryInterface     $menuRepository,
        private readonly MenuItemRepositoryInterface $menuItemRepository,
    ) {
        parent::__construct($context);
    }

    /**
     * Execute edit route action
     *
     * @return ResultInterface
     * @throws \JsonException
     */
    public function execute(): ResultInterface
    {
        $model = $this->menuFactory->create();
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();

        $id = $this->getRequest()->getParam('menu_id');
        if ($id) {
            try {
                $model = $this->menuRepository->getById($id);
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage(__('This menu no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }
        }

        $menu = $model
            ->setName($data['name'])
            ->setIsActive((bool) $data['is_active']);

        try {
            $this->menuRepository->save($menu);
            $this->messageManager->addSuccessMessage(__('You saved the menu.'));
            $this->dataPersistor->clear('kriscpg_menu_menu');
            $id = $menu->getId();
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            return $resultRedirect->setPath('*/*/');
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the menu.'));
            return $resultRedirect->setPath('*/*/');
        }

        if (!empty($data['items'])) {
            $items = json_decode(
                $data['items'],
                true,
                64,
                JSON_THROW_ON_ERROR
            );

            // DO NOT replace with foreach.
            // This loop mutates the array items and won't work with the copies that are created by foreach
            for ($i = 0, $itemsLength = count($items); $i < $itemsLength; $i++) {
                $parentId = $items[$i]['parent_id'];

                if (empty($parentId) && $parentId !== "0") {
                    unset($items[$i]['parent_id']);
                }

                $itemId = $this->menuItemRepository->createItem($items[$i], (int)$id);

                if (isset($items[$i]['children'])) {
                    foreach ($items[$i]['children'] as $childId) {
                        $items[$childId]['parent_id'] = $itemId;
                    }
                }
            }
        }

        return $resultRedirect->setPath('*/*/');
    }
}
