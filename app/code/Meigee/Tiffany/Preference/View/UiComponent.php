<?php

namespace Meigee\Tiffany\Preference\View;

use Magento\Framework\View\Layout;
use Magento\Framework\View\Layout\Reader\Context;

class UiComponent extends \Magento\Framework\View\Layout\Reader\UiComponent
{
    private $_viewCheck;

    public function __construct(Layout\ScheduledStructure\Helper $helper, \Meigee\Tiffany\Model\ViewCheck $viewCheck, $scopeType = null)
    {
        $this->_viewCheck = $viewCheck;
        parent::__construct($helper, $scopeType);
    }

    public function interpret(Context $readerContext, Layout\Element $currentElement)
    {
        $checkResult = $this->_viewCheck->check($currentElement);
        if ($checkResult === false)
        {
            return $this;
        }
        return parent::interpret($readerContext, $currentElement);
    }
}