<?php
namespace ShareASale\TrackAffiliates\Model;

use Magento\Framework\Model\AbstractModel;

class Referer extends AbstractModel
{
    /**
     * Define resource model
     */
    public function __construct(
        \Psr\Log\LoggerInterface $loggerInterface
    ) {
      $this->_init('ShareASale\TrackAffiliates\Model\Resource\News');
      $this->logger = $loggerInterface;
    }

    public function execute(){

   }
}