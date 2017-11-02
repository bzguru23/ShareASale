<?php
namespace ShareASale\TrackAffiliates\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Affiliate extends AbstractDb
{
    /**
     * constructor
     * 
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $date
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     */
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    )
    {
        parent::__construct($context);
    }
  
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
      $this->_init('affiliate', 'affiliate_id');
    }
}