<?php
namespace Pyz\Zed\ExampleMiddlewareConnector\Business\Validator\ValidationRuleSet;

use SprykerMiddleware\Zed\Process\Business\Validator\ValidationRuleSet\AbstractValidationRuleSet;
use SprykerMiddleware\Zed\Process\Communication\Plugin\Validator\NotBlankValidatorPlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\Validator\RequiredValidatorPlugin;

class ExampleProductImportValidator extends AbstractValidationRuleSet
{
    protected const NAME = 'name';
    protected const COLOR = 'color';
    /**
     * @return array
     */
    protected function getRules(): array
    {
        return [
            static::NAME => [
                RequiredValidatorPlugin::NAME,
                NotBlankValidatorPlugin::NAME,
            ],
            static::COLOR => [
                RequiredValidatorPlugin::NAME,
                NotBlankValidatorPlugin::NAME,
            ]
        ];
    }
}