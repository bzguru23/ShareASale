<?php
 
namespace ShareASale\TrackAffiliates\Block\Adminhtml;
 
use Magento\Backend\Block\Widget\Grid\Container;
 
class Affiliate extends Container
{
    protected function _construct()
    {
        $this->_blockGroup = 'ShareASale_TrackAffiliates';
        $this->_controller = 'adminhtml_affiliate';
        $this->_headerText = __('Manage Affiliate');
        $this->_addButtonLabel = __('Add New Affiliate');
        //$this->buttonList->add(
        //    'affiliate_apply',
        //    [
        //        'label' => __('Affiliate'),
        //        'onclick' => "location.href='" . $this->getUrl('affiliate/*/applyAffiliate') . "'",
        //        'class' => 'apply'
        //    ]
        //); 
        
        parent::_construct();
    }
}
