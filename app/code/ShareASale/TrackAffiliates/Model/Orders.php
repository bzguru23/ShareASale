<?php 
namespace ShareASale\TrackAffiliates\Model;

use Magento\Directory\Model\Currency;
use Magento\Framework\Api\AttributeValueFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Pricing\PriceCurrencyInterface;
use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Api\Data\OrderStatusHistoryInterface;
use Magento\Sales\Model\Order\Payment;
use Magento\Sales\Model\ResourceModel\Order\Address\Collection;
use Magento\Sales\Model\ResourceModel\Order\Creditmemo\Collection as CreditmemoCollection;
use Magento\Sales\Model\ResourceModel\Order\Invoice\Collection as InvoiceCollection;
use Magento\Sales\Model\ResourceModel\Order\Item\Collection as ImportCollection;
use Magento\Sales\Model\ResourceModel\Order\Payment\Collection as PaymentCollection;
use Magento\Sales\Model\ResourceModel\Order\Shipment\Collection as ShipmentCollection;
use Magento\Sales\Model\ResourceModel\Order\Shipment\Track\Collection as TrackCollection;
use Magento\Sales\Model\ResourceModel\Order\Status\History\Collection as HistoryCollection;

class Orders
{

    /**
     * @param \Magento\Sales\Model\Order $order
     */

    public function __construct(
        \Magento\Sales\Model\Order $order,
        \Psr\Log\LoggerInterface $loggerInterface,
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepositoryInterface
    ) {

        $this->order = $order;
        $this->logger = $loggerInterface;
        $this->orderRepository = $orderRepositoryInterface;
    }

    public function execute(){
      $this->logger->info('Model[ShareASale\TrackAffiliates\Model\Orders] loaded');

      $order = $this->order->loadByIncrementId($incrementId);
      $this->logger->info('Model[ShareASale\TrackAffiliates\Model\Orders] order => ' . json_encode($order));
      //$order->setNewAttribute('NEW VALUE');
      $order->setMerchantId('NEW VALUE');
      $order->setAffiliateId('NEW VALUE');
      $order->save();
   }
}