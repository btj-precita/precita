<?php
namespace Meigee\Tiffany\Block\Frontend;
use Magento\Framework\UrlInterface;

class BgSlider extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_scopeConfig;
    /**
     * @var UrlInterface
     */
    protected $_urlBuilder;

    /**
     * @var mixed
     */
    protected $_sliderConfig;

    /**
     * BgSlider constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        $this->_scopeConfig = $context->getScopeConfig();
        parent::__construct($context, $data);
        $this->_urlBuilder = $context->getUrlBuilder();
        $this->_sliderConfig = $this->_scopeConfig->getValue('tiffany_bg_slider/tiffany_bgslider_options', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return bool|string
     */
    function getSlides()
    {
        $status = (bool) $this->_sliderConfig['bgslider_status'];
        $slider = $this->_sliderConfig['bgslider_slides'];
        if ($status && !empty($slider)) {
            $slider =  unserialize($slider);
            $baseUrl = $url = $this->_urlBuilder->getBaseUrl(['_type' => UrlInterface::URL_TYPE_MEDIA]);

            $htmlArr = array();
            foreach ($slider as $slide) {
                $htmlArr[] = '"'.$baseUrl.$slide.'"';
            }

            return implode(',', $htmlArr);
        }

        return false;
    }

    /**
     * @return mixed
     */
    function getFade()
    {
        return $this->_sliderConfig['bgslider_fade'];
    }

    /**
     * @return mixed
     */
    function getDuration()
    {
        return $this->_sliderConfig['bgslider_duration'];
    }
}
