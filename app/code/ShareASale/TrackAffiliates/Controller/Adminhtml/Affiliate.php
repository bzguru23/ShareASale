<?php
namespace ShareASale\TrackAffiliates\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use ShareASale\TrackAffiliates\Model\AffiliateFactory;

class Affiliate extends Action
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;
 
    /**
     * @param Context $context
     * @param Registry $coreRegistry
     * @param PageFactory $resultPageFactory
     * @param NewsFactory $newsFactory
     */  
    public function __construct(
      Context $context,
      Registry $coreRegistry
    ) {
      parent::__construct($context);
      $this->_coreRegistry = $coreRegistry;
    }
  


    /**
     * Retrieve well-formed admin user data from the form input
     *
     * @param array $data
     * @return array
     */
    public function execute()
    {
      
    }
    /**
     * @return bool
     */
    protected function _isAllowed()
    {
      //$action = strtolower(str_replace(__NAMESPACE__ . '\\','', __CLASS__ ));  
      return $this->_authorization->isAllowed("ShareASale_TrackAffiliates::manage_affiliate");
    }
     
}