<?php

declare(strict_types=1);

namespace Kriscpg\Menu\Controller\Adminhtml\Menu;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

class Index extends Action
{
    /**
     * Execute index route action
     *
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        $page = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $page->setActiveMenu('Kriscpg_Menu::menu');
        $page->getConfig()->getTitle()->prepend(__('Menus'));

        return $page;
    }
}
