<?php declare(strict_types=1);

namespace Kriscpg\Menu\Controller\Adminhtml\Item;

use Kriscpg\Menu\Api\MenuItemRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Backend\App\Action\Context;

class NewAction extends Action
{
    protected $resultJsonFactory;
    protected $itemRepository;

    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory,
        MenuItemRepositoryInterface $itemRepository,
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->itemRepository = $itemRepository;
    }

    public function execute()
    {
        $request = $this->getRequest();
        $resultJson = $this->resultJsonFactory->create();
        $params = $request->getParams();

        $itemId = $this->itemRepository->createItem($params);

        return $resultJson->setData(['success' => true, 'message' => $itemId]);
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Kriscpg_menu::menu');
    }
}
