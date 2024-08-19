<?php declare(strict_types=1);

namespace Kriscpg\Menu\Controller\Adminhtml\Menu;

use Kriscpg\Menu\Api\MenuRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

class Delete extends Action
{
    public function __construct(
        Context $context,
        private readonly MenuRepositoryInterface $menuRepository,
    ) {
        parent::__construct($context);
    }

    /**
     * @inheritDoc
     */
    public function execute(): ResultInterface
    {
        $menuId = (int) $this->getRequest()->getParam('menu_id');
        $menu = $this->menuRepository->getById($menuId);

        try {
            $this->menuRepository->delete($menu);
            $this->messageManager->addSuccessMessage(
                __('The menu %1 has been deleted.', $menu->getName()),
            );
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/index');
    }
}
