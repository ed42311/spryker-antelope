<?php

namespace Pyz\Zed\ExampleProductMiddlewareConnector\Business\Translator\Dictionary;

use SprykerMiddleware\Zed\Process\Business\Translator\Dictionary\AbstractDictionary;

class ExampleProductDictionary extends AbstractDictionary
{
    /**
     * @return array
     */
    public function getDictionary(): array
    {
        return [
            'color' => 'GreyToMagenta',
        ];
    }
}
