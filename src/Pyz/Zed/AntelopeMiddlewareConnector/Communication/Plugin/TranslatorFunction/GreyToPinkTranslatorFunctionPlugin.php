<?php

namespace Pyz\Zed\AntelopeMiddlewareConnector\Communication\Plugin\TranslatorFunction;

use Pyz\Zed\AntelopeMiddlewareConnector\Business\Translator\TranslatorFunction\GreyToPink;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\TranslatorFunction\GenericTranslatorFunctionPluginInterface;

class GreyToPinkTranslatorFunctionPlugin extends AbstractPlugin implements GenericTranslatorFunctionPluginInterface
{
    protected const NAME = 'GreyToPink';

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
        return GreyToPink::class;
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
        return (new GreyToPink())->translate($value, $payload);// This is a shortcut
    }
}
