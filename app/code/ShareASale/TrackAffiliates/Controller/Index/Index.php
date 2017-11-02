<?php
namespace ShareASale\TrackAffiliates\Controller\Index;
 
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Config\ScopeConfigInterface;
use ShareASale\TrackAffiliates\Model\AffiliateFactory;
 
abstract class Index extends Action
{
  /**
   * @var \Tutorial\SimpleNews\Model\NewsFactory
   */
  protected $_modelAffiliateFactory;
  protected $scopeConfig;


  /**
   * [__construct ]
   *
   * @param CookieManagerInterface                    $cookieManager
   * @param CookieMetadataFactory                     $cookieMetadataFactory
   * @param SessionManagerInterface                   $sessionManager
   * @param \Magento\Framework\ObjectManagerInterface $objectManager
   */
  public function __construct(
    Context $context,
    AffiliateFactory $modelAffiliateFactory,
    \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    //\Psr\Log\LoggerInterface $logger
  ) {
    parent::__construct($context);
    $this->_modelAffiliateFactory = $modelAffiliateFactory;
    $this->scopeConfig = $scopeConfig;
    //$this->_logger = $logger;   
  }
  
  public function execute()
  {
    
    //$resultPageFactory = $this->resultPageFactory->create();

      // Add page title
    //$resultPageFactory->getConfig()->getTitle()->set(__('Affiliate module'));
    /**
     * When Magento get your model, it will generate a Factory class
     * for your model at var/generaton folder and we can get your
     * model by this way
     */
    $affiliateModel = $this->_modelAffiliateFactory->create();

    // Load the item with ID is 1
    $item = $affiliateModel->load(1,'affiliate_id');

    $affiliateName = [
      'firstname' => $item->getData('firstname'), 
      'lastname' => $item->getData('lastname')
    ];
    $result = [
        'firstName' => $affiliateName['firstname'],
        'lastName' => $affiliateName['lastname']
    ];
    
    $days = $this->scopeConfig->getValue('shareasale_trackaffiliates/cookie/timeout', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    
    $merchantId = $this->scopeConfig->getValue('shareasale_trackaffiliates/merchant/id', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    
    echo('Days => '.$days.'<br> MerchantId => '.$merchantId.'<br>');
    
    print_r($result);


    die();

    // Get news collection
    //ffiliateCollection = $affiliateModel->getCollection();
    // Load all data of collection
    //int_r($affiliateCollection->getData());
    //ie();
    
    return $affiliateModel;
  }  

  
}