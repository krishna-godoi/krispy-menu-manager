<?php declare(strict_types=1);

namespace Kriscpg\Menu\Controller\Adminhtml\Menu;

use Kriscpg\Menu\Api\MenuRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

class NewAction extends Action
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
        return $this->resultFactory->create(ResultFactory::TYPE_FORWARD)->forward('edit');
    }
}
