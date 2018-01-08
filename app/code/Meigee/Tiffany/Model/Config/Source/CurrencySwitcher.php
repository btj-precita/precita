<?php
namespace Meigee\Tiffany\Model\Config\Source;

class CurrencySwitcher implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
		return [
			  ['value' => 'Meigee_Tiffany::currency_select.phtml', 'label' => __('Select Box'), 'img' => 'Meigee_Tiffany::images/currency_select.png'],
			  ['value' => 'Meigee_Tiffany::currency_list.phtml', 'label' => __('Flags'), 'img' => 'Meigee_Tiffany::images/currency_images.png']
		];
    }
}