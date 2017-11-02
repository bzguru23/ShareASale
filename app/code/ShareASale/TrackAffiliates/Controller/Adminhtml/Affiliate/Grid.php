<?php
 
namespace ShareASale\TrackAffiliates\Controller\Adminhtml\Affiliate;
 
use ShareASale\TrackAffiliates\Controller\Adminhtml\Affiliate;
 
class Grid extends Affiliate
{
   /**
     * @return void
     */
   public function execute()
   {
      $this->_view->loadLayout(false);
      $this->_view->renderLayout(); 
     //return $this->_resultPageFactory->create();
   }
}