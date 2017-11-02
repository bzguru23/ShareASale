<?php
namespace ShareASale\TrackAffiliates\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Session\SessionManagerInterface;
use Magento\Framework\Stdlib\Cookie\CookieMetadataFactory;
use Magento\Framework\Stdlib\Cookie\PublicCookieMetadata;
use Magento\Framework\Stdlib\CookieManagerInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class ReferralUrlObserver implements ObserverInterface
{
  const COOKIE_REFERRAL = 'SAS_Cookie';
  
  
  /**
  * @var \Magento\Framework\App\RequestInterface
  */
  private $serverRequest;
  private $customerSession;
  private $phpCookieManager;
  private $publicCookieMetadata;
  private $cookieMetadataFactory;
  private $sessionManager;
  private $scope;
  private $logger;

  
  public function __construct(
    \Magento\Framework\App\RequestInterface $serverRequest, 
    \Magento\Customer\Model\Session $customerSession,
    \Magento\Framework\Stdlib\Cookie\PhpCookieManager $phpCookieManager,
    PublicCookieMetadata  $publicCookieMetadata,
    CookieMetadataFactory $cookieMetadataFactory,    
    \Magento\Framework\Session\SessionManagerInterface $sessionManager,
    \Magento\Framework\Stdlib\Cookie\CookieScopeInterface $scope,
    ScopeConfigInterface $scopeConfig,
    \Psr\Log\LoggerInterface $logger
  ) {
    $this->_serverRequest = $serverRequest;
    $this->customerSession = $customerSession;
    $this->phpCookieManager = $phpCookieManager;
    $this->publicCookieMetadata = $publicCookieMetadata;
    $this->cookieMetadataFactory = $cookieMetadataFactory;
    $this->sessionManager = $sessionManager;
    $this->scopeConfig = $scopeConfig;
    $this->scope = $scope;
    $this->logger = $logger;   
  }

  public function execute(\Magento\Framework\Event\Observer $observer)
  {
    
    $sasCookie = $this->phpCookieManager->getCookie('SAS_Cookie');
    $sasCookie1 = $this->phpCookieManager->getCookie('SAS_Cookie1');
    $sasCookie2 = $this->phpCookieManager->getCookie('SAS_Cookie2');
    $sasCookie3 = $this->customerSession->getSasCookie3();
    
    if (strpos($sasCookie, 'shareasale') !== false || strpos($sasCookie, 'valleyforge') !== false ) {
      $this->logger->info('SAS cookie already set! End');
    }else{
    
     /* if (strpos($sasCookie1, 'shareasale') !== false || strpos($sasCookie1, 'valleyforge') !== false ) {
      echo 'true';
      }
      if (strpos($sasCookie2, 'are') !== false) {
      echo 'true';
      }
      if (strpos($sasCookie3, 'are') !== false) {
      echo 'true';
      }
      if (strpos($sasCookie4, 'are') !== false) {
      echo 'true';
      }*/
    
    //Observer execution code...
    //$om = \Magento\Framework\App\ObjectManager::getInstance(); 
    $this->logger->info('ReferralUrlObserver started');

    $httpRefererRaw = $this->_serverRequest->getServerValue('HTTP_REFERER');
    $httpReferer = urldecode($httpRefererRaw);

    $setCookie = $this->createSasCookie($httpReferer);
    
    $this->logger->info('ReferralUrlObserver ended');
    }
  }

  private function getRefererUrl($string)
  {
    $urlArray = explode('|' , $string);
    $this->logger->info('getRefererUrl => '.$urlArray[1]);
    return $urlArray[1];
  }  
  
  
  private function createSasCookie($value)
  {
    //$duration = 86400 * 30;
    $duration = $this->_getCookieLifetime();
    
    $metadata = $this->cookieMetadataFactory
          ->createPublicCookieMetadata()
            ->setDuration($duration)
            ->setPath($this->sessionManager->getCookiePath())
            ->setDomain($this->sessionManager->getCookieDomain());
    
    $metaDataArray = $this->scope->getPublicCookieMetadata($metadata);
      
    $this->phpCookieManager->setPublicCookie('SAS_Cookie',$value, $metaDataArray );    
    //$this->phpCookieManager->setPublicCookie('SAS_Cookie2',$value);
    //$this->customerSession->setSasCookie3($value);
    
    //$this->customerSession->getSasCookie3();

    //setcookie('SAS_Cookie4', $value, time() + (86400 * 30), "/"); // 86400 = 1 day
    $this->phpCookieManager->getCookie('SAS_Cookie');
    
    $result = 'TODO getCookie Value here';
    /*
    if(!isset($_COOKIE['SAS_Cookie4'])) {
        $result = 'Cookie is not set!';
    } else {
        //echo "Cookie '" . $cookie_name . "' is set!<br>";
        $result = $_COOKIE['SAS_Cookie4'];
    }
    */
    
    $this->logger->info('SasCookie set as => ' . $result );
    
    $this->logger->info('createSasCookie complete');
    return $result;
  }
  
  
  
  protected function _getCookieLifetime()
  {
    $days = $this->scopeConfig->getValue('shareasale_trackaffiliates/cookie/timeout', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);

    // convert to seconds
    return (int)86400 * $days;
  }  
}
