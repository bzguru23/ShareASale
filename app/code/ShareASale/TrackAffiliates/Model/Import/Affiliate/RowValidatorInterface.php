<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace ShareASale\TrackAffiliates\Model\Import\Affiliate;
interface RowValidatorInterface extends \Magento\Framework\Validator\ValidatorInterface
{
       const ERROR_INVALID_TITLE= 'InvalidValueTITLE';
       const ERROR_TITLE_IS_EMPTY = 'EmptyTITLE';
    /**
     * Initialize validator
     *
     * @return $this
     */
    public function init($context);
}