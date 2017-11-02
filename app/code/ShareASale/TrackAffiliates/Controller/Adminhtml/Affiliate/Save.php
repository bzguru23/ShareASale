<?php
/**
 *
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace ShareASale\TrackAffiliates\Controller\Adminhtml\Affiliate;

use Magento\Framework\App\TemplateTypesInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Controller\ResultFactory;

class Save extends \ShareASale\TrackAffiliates\Controller\Adminhtml\Affiliate
{
    /**
     * Save Newsletter Template
     *
     * @return void
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $request = $this->getRequest();
        if (!$request->isPost()) {
            $this->getResponse()->setRedirect($this->getUrl('*/affiliate'));
        }
   
         $template = $this->_objectManager->create('ShareASale\TrackAffiliates\Model\Affiliate');
        $id = (int)$request->getParam('id');

        if ($id) {
            $template->load($id);
        }

        try {
            $data = $request->getParams();
                       
            
            
            $template->setData('name',
                $request->getParam('name')
            )->setData('background',
                $data['background']
            )->setData('stylecolor',
                $request->getParam('stylecolor')
            )->setData('textcolor',
                $request->getParam('textcolor')
            )->setData('status',
                $request->getParam('status')
            );

           

            $template->save();

            $this->messageManager->addSuccess(__('The gift card template has been saved.'));
            $this->_getSession()->setFormData(false);

            
        } catch (LocalizedException $e) {
            
            $this->messageManager->addError(nl2br($e->getMessage()));
            $this->_getSession()->setData('shareasale_affiliate_form_data', $this->getRequest()->getParams());
            return $resultRedirect->setPath('*/*/edit', ['id' => $template->getAffiliateaffiliateId(), '_current' => true]);
        } catch (\Exception $e) {
            
            $this->messageManager->addException($e, __('Something went wrong while saving this template.'));
            $this->_getSession()->setData('shareasale_affiliate_form_data', $this->getRequest()->getParams());
            return $resultRedirect->setPath('*/*/edit', ['id' => $template->getAffiliateaffiliateId(), '_current' => true]);
        }

        return $resultRedirect->setPath('*/*/');
    }
}
