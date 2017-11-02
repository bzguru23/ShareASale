<?php
/**
 *
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace ShareASale\TrackAffiliates\Controller\Adminhtml\Affiliate;

use \Magento\Backend\App\Action\Context;
use \Magento\Framework\Registry;

class Edit extends \ShareASale\TrackAffiliates\Controller\Adminhtml\Affiliate
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     */
    public function __construct(
      Context $context, 
      Registry $coreRegistry
    )
    {
      parent::__construct($context);  
      $this->_coreRegistry = $coreRegistry;
        
    }

    /**
     * Edit Newsletter Template
     *
     * @return void
     */
    public function execute()
    {
        $model = $this->_objectManager->create('ShareASale\TrackAffiliates\Model\Affiliate');
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            $model->load($id);
        }

        $this->_coreRegistry->register('_shareasale_affiliate', $model);

        $this->_view->loadLayout();
        $this->_setActiveMenu('ShareASale_TrackAffiliates::affiliate');

        if ($model->getId()) {
            $breadcrumbTitle = __('Edit Affiliate');
            $breadcrumbLabel = $breadcrumbTitle;
        } else {
            $breadcrumbTitle = __('New Affiliate');
            $breadcrumbLabel = __('Create  Affiliate');
        }
        $this->_view->getPage()->getConfig()->getTitle()->prepend(__(' Affiliate'));
        $this->_view->getPage()->getConfig()->getTitle()->prepend(
            $model->getId() ? $model->getTemplateId() : __('New Affiliate')
        );

        $this->_addBreadcrumb($breadcrumbLabel, $breadcrumbTitle);

        // restore data
        $values = $this->_getSession()->getData('shareasale_affiliate_form_data', true);
        if ($values) {
            $model->addData($values);
        }

        $this->_view->renderLayout();
    }
}
