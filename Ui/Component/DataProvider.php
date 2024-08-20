<?php

declare(strict_types=1);

namespace Kriscpg\Menu\Ui\Component;

use Kriscpg\Menu\Model\Menu;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider as SourceDataProvider;

class DataProvider extends SourceDataProvider
{
    /**
     * @param SearchResultsInterface $searchResult
     * @return array
     */
    protected function searchResultToOutput(SearchResultsInterface $searchResult): array
    {
        $arrItems = [];

        $arrItems['items'] = [];
        /** @var Menu $item */
        foreach ($searchResult->getItems() as $item) {
            $arrItems['items'][] = $item->getData();
        }

        $arrItems['totalRecords'] = $searchResult->getTotalCount();

        return $arrItems;
    }
}
