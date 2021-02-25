<?php

namespace Pyz\Zed\ExampleProductMiddlewareConnector\Communication\Plugin\TranslatorFunction;

use Pyz\Zed\ExampleProductMiddlewareConnector\Business\Translator\TranslatorFunction\GreyToMagenta;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\TranslatorFunction\GenericTranslatorFunctionPluginInterface;

class GreyToMagentaTranslatorFunctionPlugin extends AbstractPlugin implements GenericTranslatorFunctionPluginInterface
{
    protected const NAME = 'GreyToMagenta';

    /**
     * @return string
     */
    public function getName(): string
    {
        return static::NAME;
    }

    /**
     * @return string
     */
    public function getTranslatorFunctionClassName(): string
    {
        return GreyToMagenta::class;
    }

    /**
     * @param mixed $value
     * @param array $payload
     * @param string $key
     * @param array $options
     *
     * @return mixed
     */
    public function translate($value, array $payload, string $key, array $options)
    {
        return (new GreyToMagenta())->translate($value, $payload);// This is a shortcut
    }
}
