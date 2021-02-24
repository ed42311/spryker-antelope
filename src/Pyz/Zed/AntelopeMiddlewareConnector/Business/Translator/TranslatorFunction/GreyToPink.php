<?php

namespace Pyz\Zed\AntelopeMiddlewareConnector\Business\Translator\TranslatorFunction;

use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\AbstractTranslatorFunction;
use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\TranslatorFunctionInterface;

class GreyToPink extends AbstractTranslatorFunction implements TranslatorFunctionInterface
{
    protected const COLOR_GREY = 'grey';
    protected const COLOR_PINK = 'pink';

    /**
     * @param mixed $value
     * @param array $payload
     *
     * @return mixed
     */
    public function translate($value, array $payload)
    {
        if ($value === static::COLOR_GREY) {
            return static::COLOR_PINK;
        }

        return $value;
    }
}
