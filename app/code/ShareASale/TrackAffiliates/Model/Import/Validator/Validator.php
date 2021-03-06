<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace ShareASale\TrackAffiliates\Model\Import\Validator;
use ShareASale\TrackAffiliates\Model\Import\Affiliate\RowValidatorInterface;
use \Magento\Framework\Validator\AbstractValidator;
class Validator extends AbstractValidator implements RowValidatorInterface
{
    /**
     * @var RowValidatorInterface[]|AbstractValidator[]
     */
    protected $validators = [];
    /**
     * @param RowValidatorInterface[] $validators
     */
    public function __construct($validators = [])
    {
        $this->validators = $validators;
    }
    /**
     * Check value is valid
     *
     * @param array $value
     * @return bool
     */
    public function isValid($value)
    {
        $returnValue = true;
        $this->_clearMessages();
        foreach ($this->validators as $validator) {
            if (!$validator->isValid($value)) {
                $returnValue = false;
                $this->_addMessages($validator->getMessages());
            }
        }
        return $returnValue;
    }
    /**
     * @param \Magento\CatalogImportExport\Model\Import\Product $context
     * @return $this
     */
    public function init($context)
    {
        foreach ($this->validators as $validator) {
            $validator->init($context);
        }
        return $this;
    }
}
