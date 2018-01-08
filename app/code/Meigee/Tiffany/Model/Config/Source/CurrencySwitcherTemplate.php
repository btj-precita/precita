<?php
namespace Meigee\Tiffany\Model\Config\Source;

class CurrencySwitcherTemplate implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
		return [
			  ['value' => 'currency_select', 'label' => __('Select Box'), 'img' => 'Meigee_Tiffany::images/currency_select.png'],
			  ['value' => 'currency_images', 'label' => __('Flags'), 'img' => 'Meigee_Tiffany::images/currency_images.png']
		];
    }
}