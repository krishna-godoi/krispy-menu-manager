<?php

declare(strict_types=1);

namespace Kriscpg\Menu\Model\ResourceModel\Menu\Grid;

use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\Api\Search\AggregationInterface;
use Kriscpg\Menu\Model\ResourceModel\Menu\Collection as MenuCollection;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface;
use Magento\Framework\Data\Collection\EntityFactoryInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\Document;
use Psr\Log\LoggerInterface;

/**
 * Collection for displaying grid of sales documents
 */
class Collection extends MenuCollection implements SearchResultInterface
{
    /**
     * @var TimezoneInterface
     */
    private TimezoneInterface $timeZone;

    /**
     * @var AggregationInterface
     */
    protected AggregationInterface $aggregations;

    /**
     * @param EntityFactoryInterface $entityFactory
     * @param LoggerInterface $logger
     * @param FetchStrategyInterface $fetchStrategy
     * @param ManagerInterface $eventManager
     * @param $mainTable
     * @param $eventPrefix
     * @param $eventObject
     * @param $resourceModel
     * @param TimezoneInterface $timeZone
     * @param $model
     * @param AdapterInterface|null $connection
     * @param AbstractDb|null $resource
     */
    public function __construct(
        \Magento\Framework\Data\Collection\EntityFactoryInterface    $entityFactory,
        \Psr\Log\LoggerInterface                                     $logger,
        \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy,
        ManagerInterface                                             $eventManager,
        $mainTable,
        $eventPrefix,
        $eventObject,
        $resourceModel,
        TimezoneInterface $timeZone,
        $model = Document::class,
        \Magento\Framework\DB\Adapter\AdapterInterface               $connection = null,
        \Magento\Framework\Model\ResourceModel\Db\AbstractDb         $resource = null,
    ) {
        $this->_eventPrefix = $eventPrefix;
        $this->_eventObject = $eventObject;
        $this->_init($model, $resourceModel);
        $this->setMainTable($mainTable);
        $this->timeZone = $timeZone;
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $connection, $resource);
    }

    /**
     * @inheritDoc
     */
    public function _resetState(): void
    {
        parent::_resetState();
        $this->_init($this->model, $this->resourceModel);
    }

    /**
     * @inheritDoc
     *
     * @throws LocalizedException
     */
    public function addFieldToFilter($field, $condition = null)
    {
        if ($field === 'created_at' || $field === 'updated_at') {
            if (is_array($condition)) {
                foreach ($condition as $key => $value) {
                        $condition[$key] = $this->timeZone->convertConfigTimeToUtc($value);
                }
            }
        }

        return parent::addFieldToFilter($field, $condition);
    }

    /**
     * Get aggregation interface instance
     *
     * @return AggregationInterface
     */
    public function getAggregations()
    {
        return $this->aggregations;
    }

    /**
     * Set aggregation interface instance
     *
     * @param AggregationInterface $aggregations
     * @return $this
     */
    public function setAggregations($aggregations)
    {
        $this->aggregations = $aggregations;
        return $this;
    }

    /**
     * Get search criteria.
     *
     * @return \Magento\Framework\Api\SearchCriteriaInterface|null
     */
    public function getSearchCriteria()
    {
        return null;
    }

    /**
     * Set search criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return $this
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function setSearchCriteria(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria = null)
    {
        return $this;
    }

    /**
     * Get total count.
     *
     * @return int
     */
    public function getTotalCount()
    {
        return $this->getSize();
    }

    /**
     * Set total count.
     *
     * @param int $totalCount
     * @return $this
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function setTotalCount($totalCount)
    {
        return $this;
    }

    /**
     * Set items list.
     *
     * @param \Magento\Framework\Api\ExtensibleDataInterface[] $items
     * @return $this
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function setItems(array $items = null)
    {
        return $this;
    }
}
