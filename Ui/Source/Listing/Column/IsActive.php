<?php

declare(strict_types=1);

namespace Kriscpg\Menu\Ui\Source\Listing\Column;

use Magento\Framework\Data\OptionSourceInterface;

class IsActive implements OptionSourceInterface
{
    private const int ENABLED = 1;
    private const int DISABLED = 0;

    /**
     * Map int to option array
     *
     * @return array[]
     */
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
