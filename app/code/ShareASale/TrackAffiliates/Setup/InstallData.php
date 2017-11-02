<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace ShareASale\TrackAffiliates\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use ShareASale\TrackAffiliates\Model\AffiliateFactory;

class InstallData implements InstallDataInterface
{
    protected $affiliateFactory;
    
    public function __construct
    (
      //ModuleContextInterface $context,
      //ModuleDataSetupInterface $setup,       
      \ShareASale\TrackAffiliates\Model\Affiliate $affiliate,
      array $data = []
    )
    {
      //parent::__construct($context, $data);
      //$this->affiliateFactory = $affiliateFactory;
        
    }
    
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
      if(
        !$setup->getConnection()->query(" SELECT EXISTS(SELECT status FROM sales_order_status WHERE status = 'shareasale')")
      )
      {
        $setup->getConnection()->query("INSERT INTO sales_order_status SET status = 'shareasale', label = 'ShareASale'");
      }
        $this->affiliate->install(['ShareASale_TrackAffiliates::fixtures/affiliate.csv']);
        $affiliate = $this->affiliateFactory->create();
        
        
    }
}
