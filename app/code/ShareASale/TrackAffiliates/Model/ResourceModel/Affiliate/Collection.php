<?php
namespace ShareASale\TrackAffiliates\Model\ResourceModel\Affiliate;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
      $this->_init(
        'ShareASale\TrackAffiliates\Model\Affiliate', 
        'ShareASale\TrackAffiliates\Model\ResourceModel\Affiliate'
      );
    }
}