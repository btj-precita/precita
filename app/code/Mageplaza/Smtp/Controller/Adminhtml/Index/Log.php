<?php
/**
 * Mageplaza
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the mageplaza.com license that is
 * available through the world-wide-web at this URL:
 * https://mageplaza.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Mageplaza
 * @package     Mageplaza_Smtp
 * @copyright   Copyright (c) 2017 Mageplaza (https://www.mageplaza.com/)
 * @license     http://mageplaza.com/LICENSE.txt
 */

namespace Mageplaza\Smtp\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Log
 * @package Mageplaza\Smtp\Controller\Adminhtml\Index
 */
class Log extends Action
{
	/**
	 * Authorization level of a basic admin session
	 *
	 * @see _isAllowed()
	 */
	const ADMIN_RESOURCE = 'Mageplaza_Smtp::smtp';

	/**
	 * @var \Magento\Framework\View\Result\PageFactory
	 */
	protected $resultPageFactory;

	/**
	 * Constructor
	 *
	 * @param \Magento\Backend\App\Action\Context $context
	 * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
	 */
	public function __construct(
		Context $context,
		PageFactory $resultPageFactory
	)
	{
		parent::__construct($context);

		$this->resultPageFactory = $resultPageFactory;
	}

	/**
	 * @return \Magento\Framework\View\Result\Page
	 */
	public function execute()
	{
		$resultPage = $this->resultPageFactory->create();
		$resultPage->setActiveMenu('Mageplaza_Smtp::log');
		$resultPage->getConfig()->getTitle()->prepend((__('Emails Log')));

		//Add bread crumb
		$resultPage->addBreadcrumb(__('Mageplaza'), __('Mageplaza'));
		$resultPage->addBreadcrumb(__('Smtp'), __('Emails Log'));

		return $resultPage;
	}
}
