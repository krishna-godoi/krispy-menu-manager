<?php

namespace Kriscpg\Menu\Ui\Source\Listing\Column;

class isActive implements \Magento\Framework\Data\OptionSourceInterface
{
    private const int ENABLED = 1;
    private const int DISABLED = 0;

    public function toOptionArray(): array
    {
        return [
            [
                'value' => self::ENABLED,
                'label' => __('Enabled'),
            ],
            [
                'value' => self::DISABLED,
                'label' => __('Disabled'),
            ]
        ];
    }
}
