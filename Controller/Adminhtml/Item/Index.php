<?php

declare(strict_types=1);

namespace Kriscpg\Menu\Controller\Adminhtml\Item;

use Kriscpg\Menu\Api\MenuItemRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaInterfaceFactory;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Backend\App\Action\Context;

class Index extends Action
{
    protected $resultJsonFactory;
    protected $itemRepository;

    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory,
        MenuItemRepositoryInterface $itemRepository,
        private SearchCriteriaBuilder $searchCriteriaBuilder

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

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Kriscpg_menu::menu');
    }
}
