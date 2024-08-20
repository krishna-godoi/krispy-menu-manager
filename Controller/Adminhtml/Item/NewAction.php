<?php

declare(strict_types=1);

namespace Kriscpg\Menu\Controller\Adminhtml\Item;

use Kriscpg\Menu\Api\MenuItemRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultInterface;

class NewAction extends Action
{
    /**
     * @var JsonFactory $resultJsonFactory
     */
    protected JsonFactory $resultJsonFactory;

    /**
     * @var MenuItemRepositoryInterface $itemRepository
     */
    protected MenuItemRepositoryInterface $itemRepository;

    /**
     * @param Context $context
     * @param JsonFactory $resultJsonFactory
     * @param MenuItemRepositoryInterface $itemRepository
     */
    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory,
        MenuItemRepositoryInterface $itemRepository,
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->itemRepository = $itemRepository;
    }

    /**
     * Execute new route action
     *
     * @return ResponseInterface|Json|ResultInterface
     */
    public function execute(): ResponseInterface|Json|ResultInterface
    {
        $request = $this->getRequest();
        $resultJson = $this->resultJsonFactory->create();
        $params = $request->getParams();

        $itemId = $this->itemRepository->createItem($params);

        return $resultJson->setData(['success' => true, 'message' => $itemId]);
    }

    /**
     * Request validator
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Kriscpg_menu::menu');
    }
}
