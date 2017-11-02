<?php
/**
 *
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace ShareASale\TrackAffiliates\Controller\Adminhtml\Affiliate;

class NewAction extends \ShareASale\TrackAffiliates\Controller\Adminhtml\Affiliate
{
    /**
     * Create new Newsletter Template
     *
     * @return void
     */
    public function execute()
    {
        $this->_forward('edit');
    }
}
