<?php

declare(strict_types=1);

namespace Kriscpg\Menu\Controller\Adminhtml\Item;

use Kriscpg\Menu\Api\MenuItemRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaInterfaceFactory;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultInterface;

class Index extends Action
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
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory,
        MenuItemRepositoryInterface $itemRepository,
        private readonly SearchCriteriaBuilder $searchCriteriaBuilder

    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->itemRepository = $itemRepository;
    }

    /**
     * Execute index route action
     *
     * @return ResponseInterface|Json|ResultInterface
     */
    public function execute(): ResponseInterface|Json|ResultInterface
    {
        $request = $this->getRequest();
        $resultJson = $this->resultJsonFactory->create();
        $params = $request->getParams();
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('builder_key', $params['builder_key'])
            ->create();

        $data = $this->itemRepository->getList($searchCriteria);

        $items = [];

        foreach ($data->getItems() as $item) {
            $items[] = $item->getData();
        }

        return $resultJson->setData($items);
    }

    /**
     * Request validator
     *
     * @return bool
     */
    protected function _isAllowed(): bool
    {
        return $this->_authorization->isAllowed('Kriscpg_menu::menu');
    }
}
