<?php
namespace ShareASale\TrackAffiliates\Controller\Index;

/*use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Stdlib\CookieManagerInterface;
use Magento\Framework\Stdlib\Cookie\CookieMetadataFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Psr\Log\LoggerInterface;*/

/**
 * Inchoo Custom router Controller Router
 *
 * @author      Zoran Salamun <zoran.salamun@inchoo.net>
 */
class ExtendIndex extends \Magento\Cms\Controller\Index\Index
{      
    public function execute($coreRoute = null)
    { 

      //$this->messageManager->addSuccess('Message from new controller.');
      return parent::execute($coreRoute);
    }
}