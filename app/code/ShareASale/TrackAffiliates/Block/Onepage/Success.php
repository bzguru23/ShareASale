<?php
namespace ShareASale\TrackAffiliates\Block\Onepage;
//namespace Magento\Checkout\Controller\Onepage;

/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
//namespace Magento\Checkout\Block\Onepage;

use Magento\Customer\Model\Context;
use Magento\Sales\Model\Order;
use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * One page checkout success page
 */
class Success extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Checkout\Model\Session
     */
    protected $_checkoutSession;

    /**
     * @var \Magento\Sales\Model\Order\Config
     */
    protected $_orderConfig;

    /**
     * @var \Magento\Framework\App\Http\Context
     */
    protected $httpContext;
  
    protected $scopeConfig;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Checkout\Model\Session $checkoutSession
     * @param \Magento\Sales\Model\Order\Config $orderConfig
     * @param \Magento\Framework\App\Http\Context $httpContext
     * @param array $data
     */
    public function __construct(
      \Magento\Framework\View\Element\Template\Context $context,
      \Magento\Checkout\Model\Session $checkoutSession,
      \Magento\Sales\Model\Order\Config $orderConfig,
      \Magento\Framework\App\Http\Context $httpContext,
      \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
      array $data = []
    ) {
      parent::__construct($context, $data);
      $this->_checkoutSession = $checkoutSession;
      $this->_orderConfig = $orderConfig;
      $this->_isScopePrivate = true;
      $this->httpContext = $httpContext;
      $this->scopeConfig = $scopeConfig;
    }

    /**
     * Render additional order information lines and return result html
     *
     * @return string
     */
    public function getAdditionalInfoHtml()
    {
        return $this->_layout->renderElement('order.success.additional.info');
    }

    /**
     * Initialize data and prepare it for output
     *
     * @return string
     */
    protected function _beforeToHtml()
    {
        $this->prepareBlockData();
        return parent::_beforeToHtml();
    }

    /**
     * Prepares block data
     *
     * @return void
     */
    protected function prepareBlockData()
    {
        $order = $this->_checkoutSession->getLastRealOrder();

        $this->addData(
            [
                'is_order_visible' => $this->isVisible($order),
                'view_order_url' => $this->getUrl(
                    'sales/order/view/',
                    ['order_id' => $order->getEntityId()]
                ),
                'print_url' => $this->getUrl(
                    'sales/order/print',
                    ['order_id' => $order->getEntityId()]
                ),
                'can_print_order' => $this->isVisible($order),
                'can_view_order'  => $this->canViewOrder($order),
                'order_id'  => $order->getIncrementId()
            ]
        );
    }

    /**
     * Is order visible
     *
     * @param Order $order
     * @return bool
     */
    protected function isVisible(Order $order)
    {
        return !in_array(
            $order->getStatus(),
            $this->_orderConfig->getInvisibleOnFrontStatuses()
        );
    }

    /**
     * Can view order
     *
     * @param Order $order
     * @return bool
     */
    protected function canViewOrder(Order $order)
    {
        return $this->httpContext->getValue(Context::CONTEXT_AUTH)
            && $this->isVisible($order);
    }
  
    public function getSomething()
    {
      return 'returned something from custom block.';
    } 

    public function getMerchants()
    {
      $merchants = array(
        '66031',
        '66032',
        '66033'
      ); 

      return $merchants;

    }
    public function getMerchant()  
    {
      return $this->scopeConfig->getValue('shareasale_trackaffiliates/merchant/id', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
      
    }
}
