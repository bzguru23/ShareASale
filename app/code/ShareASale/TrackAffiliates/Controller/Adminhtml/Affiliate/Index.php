<?php
namespace ShareASale\TrackAffiliates\Controller\Adminhtml\Affiliate;

use ShareASale\TrackAffiliates\Controller\Adminhtml\Affiliate;
use Magento\Backend\App\Action;

class Index extends Action
{
  protected $resultPageFactory = false;
  
	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory
	) {
		parent::__construct($context);
		$this->resultPageFactory = $resultPageFactory;
	}
  
  //public function executeInternal()
  public function execute()
  {
    $resultPage = $this->resultPageFactory->create();
    $resultPage->setActiveMenu('ShareASale_TrackAffiliates::affiliate');
    $resultPage->getConfig()->getTitle()->prepend(__('Affiliates'));

    //Add bread crumb
    $resultPage->addBreadcrumb(__('ShareASale'), __('Affiliates'));
    $resultPage->addBreadcrumb(__('Hello World'), __('Manage Affiliates'));
    return $resultPage;
  }
  
	/*
	 * Check permission via ACL resource
	 */
	protected function _isAllowed()
	{
		return $this->_authorization->isAllowed('ShareASale_TrackAffiliates::affiliate_manage');
	}


}