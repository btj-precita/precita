<?php
namespace Meigee\Tiffany\Block\Frontend;
use Magento\Framework\UrlInterface;

class BgSlider  extends \Magento\Framework\View\Element\Template
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
     * @param UrlInterface $urlBuilder
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        UrlInterface $urlBuilder,
        array $data = []
    )
    {
        $this->_scopeConfig = $context->getScopeConfig();
        parent::__construct($context, $data);
        $this->_urlBuilder = $urlBuilder;
        $this->_sliderConfig = $this->_scopeConfig->getValue('tiffany_bg_slider/tiffany_bgslider_options', \Magento\Store\Model\ScopeInterface::SCOPE_STORE );
    }

    /**
     * @return bool|string
     */
    function getSlides()
    {
        $status = (bool)$this->_sliderConfig['bgslider_status'];
        $slider = $this->_sliderConfig['bgslider_slides'];
        if ($status && !empty($slider))
        {
            $slider =  unserialize($slider);
            $base_url = $url = $this->_urlBuilder->getBaseUrl(['_type' => UrlInterface::URL_TYPE_MEDIA]);

            $html_arr = array();
            foreach ($slider AS $slide) {
                $html_arr[] = '"'.$base_url . $slide . '"';
            }
            return implode(',', $html_arr);
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
