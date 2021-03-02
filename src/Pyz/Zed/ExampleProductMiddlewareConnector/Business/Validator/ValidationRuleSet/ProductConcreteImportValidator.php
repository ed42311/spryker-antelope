<?php

namespace Pyz\Zed\ExampleProductMiddlewareConnector\Business\Validator\ValidationRuleSet;

use SprykerMiddleware\Zed\Process\Business\Validator\ValidationRuleSet\AbstractValidationRuleSet;
use SprykerMiddleware\Zed\Process\Communication\Plugin\Validator\NotBlankValidatorPlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\Validator\RequiredValidatorPlugin;

class ProductConcreteImportValidator extends AbstractValidationRuleSet
{
    protected const CONCRETE_SKU_KEY = 'item.*.@sku';
    protected const ABSTRACT_SKU_KEY = 'item.*.productSKU';
    protected const CONCRETE_NAME_KEY = 'item.*.name';

    /**
     * @return array
     */
    protected function getRules(): array
    {
        return [
            static::CONCRETE_SKU_KEY => [
                RequiredValidatorPlugin::NAME,
                NotBlankValidatorPlugin::NAME,
            ],
            static::ABSTRACT_SKU_KEY => [
                RequiredValidatorPlugin::NAME,
                NotBlankValidatorPlugin::NAME,
            ],
            static::CONCRETE_NAME_KEY => [
                RequiredValidatorPlugin::NAME,
            ],
        ];
    }
}
