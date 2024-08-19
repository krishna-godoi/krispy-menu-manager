<?php declare(strict_types=1);

namespace Kriscpg\Menu\Controller\Adminhtml\Menu;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;

class Edit extends Action
{
    /** @var Page $page */
    public function execute(): ResultInterface
    {
        $page = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $page->setActiveMenu('Kriscpg_Menu::menu');
        $page->getConfig()->getTitle()->prepend(__('New Menu'));

        return $page;
    }
}
