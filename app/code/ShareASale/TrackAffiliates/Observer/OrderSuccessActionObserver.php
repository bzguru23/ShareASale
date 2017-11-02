<?php
namespace ShareASale\TrackAffiliates\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Session\SessionManagerInterface;
use Magento\Framework\Stdlib\Cookie\CookieMetadataFactory;
use Magento\Framework\Stdlib\Cookie\PublicCookieMetadata;
use Magento\Framework\Stdlib\CookieManagerInterface;
use Magento\Framework\Api\ExtensionAttributesFactory;
use ShareASale\TrackAffiliates\Model\AffiliateFactory;

class OrderSuccessActionObserver implements ObserverInterface
{
  
  /**
  * @var \Magento\Framework\App\RequestInterface
  */
  protected $order;
  protected $objectManager;
  protected $extensionFactory;
  protected $orderRepositoryInterface;
  protected $checkoutSession;
  
  protected $phpCookieManager;
  protected $cookieMetadataFactory;
  protected $sessionManager;
  protected $scope;
  protected $_modelAffiliateFactory;
  protected $logger;

  
  public function __construct( 
    \Magento\Sales\Model\Order $order,
    \Magento\Framework\ObjectManagerInterface $objectManager,
    ExtensionAttributesFactory $extensionFactory,
    //\Magento\Sales\Api\OrderRepositoryInterface $orderRepositoryInterface,
    \Magento\Checkout\Model\Session $checkoutSession,
    \Magento\Customer\Model\Session $customerSession,
    \Magento\Framework\Stdlib\Cookie\PhpCookieManager $phpCookieManager,
    PublicCookieMetadata  $publicCookieMetadata,
    CookieMetadataFactory $cookieMetadataFactory,    
    \Magento\Framework\Session\SessionManagerInterface $sessionManager,
    \Magento\Framework\Stdlib\Cookie\CookieScopeInterface $scope,
    AffiliateFactory $modelAffiliateFactory,
    \Psr\Log\LoggerInterface $logger
  ) {
    //Observer initialization code...
    //You can use dependency injection to get any class this observer may need.
    $this->order = $order;
    $this->objectManager = $objectManager;
    $this->extensionAttributesFactory = $extensionFactory;
    //$this->orderRepository = $orderRepositoryInterface;
    $this->_checkoutSession = $checkoutSession;
    $this->customerSession = $customerSession;
    $this->phpCookieManager = $phpCookieManager;
    $this->publicCookieMetadata = $publicCookieMetadata;
    $this->cookieMetadataFactory = $cookieMetadataFactory;
    $this->sessionManager = $sessionManager;
    $this->scope = $scope;
    $this->_modelAffiliateFactory = $modelAffiliateFactory;
    $this->logger = $logger;
  }

  public function execute(\Magento\Framework\Event\Observer $observer)
  {
    //Observer execution code...
    $this->logger->info('OrderSuccessActionObserver called');
    $sessionOrder = $this->_checkoutSession->getLastRealOrder();
    $orderId = $sessionOrder->getIncrementId();
    $this->logger->info('$orderId => '.$orderId);
    $order = $this->order->loadByIncrementId($orderId);   
    $jsonOrder = json_encode($order);
    $this->logger->info('order => ' . $jsonOrder);

    $sasCookie = $this->phpCookieManager->getCookie('SAS_Cookie');

    $sasCookie1 = $this->phpCookieManager->getCookie('SAS_Cookie1');
    $sasCookie2 = $this->phpCookieManager->getCookie('SAS_Cookie2');
    $sasCookie3 = $this->customerSession->getSasCookie3();
    
    $this->logger->info('$sasCookie => ' . $sasCookie);
    $this->logger->info('$sasCookie1 => ' . $sasCookie1);
    $this->logger->info('$sasCookie2 => ' . $sasCookie2);
    $this->logger->info('$sasCookie3 => ' . $sasCookie3);
    //$this->logger->info('$sasCookie4 => ' . $sasCookie4);
    
    
    
    //if($this->getTrackingData($cookieData) !== false){
      
      $affiliateData = $this->getTrackingData($sasCookie);
      $jsonAffiliateData = json_encode($affiliateData);
      
      //$this->createSasCookie($jsonAffiliateData);
      
      // Add the comment and save the order (last parameter will determine if comment will be sent to customer)
      $comment = 'ShareASale transaction details ['.$jsonAffiliateData.']';
      $this->logger->info('ShareASale => '.$comment.'], $sasCookie => ['.$sasCookie.']');
      $order->setStatus('shareasale');
      $order->addStatusHistoryComment($comment);
      $order->save();
    //}else{
    //  $this->logger->info('Non-ShareASale transaction');
    //}  
    
    $this->logger->info('OrderSuccessActionObserver completd');
  }
  
  private function getTrackingData($string)
  {
    //echo("<div class='cookiestring'>".$string."</div>");
    $this->logger->info('cookie string => '.$string);
    //$urlArray = explode('|' , $string);
    
    $params = explode('?' , $string);
    //if(strpos($params[0], 'shareasale') !== false)
    if(strpos($params[0], 'shareasale') !== false || strpos($params[0], 'valleyforge') !== false)
    {
      parse_str($params[1],$result);
      
      $affiliateName = $this->getAffiliateName($result['u']);
      
      $results = [
        //'merchantId' => $result['m'],
        'affiliateId' => $result['u'],
        'firstName' => $affiliateName['firstname'],
        'lastName' => $affiliateName['lastname']
      ];

      return $results;
    } else {
      return false;
    }
  }
  
  private function getAffiliateName($affiliate_id)
  {
    $affiliateModel = $this->_modelAffiliateFactory->create();

    // Load the item with ID is 1
    $item = $affiliateModel->load($affiliate_id,'affiliate_id');
    
    $result = [
      'firstname' => $item->getData('firstname'), 
      'lastname' => $item->getData('lastname')
    ];
    
    return $result;
  }
  
}
