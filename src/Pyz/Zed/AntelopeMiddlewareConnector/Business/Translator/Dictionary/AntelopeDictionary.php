<?php

namespace Pyz\Zed\AntelopeMiddlewareConnector\Business\Translator\Dictionary;

use SprykerMiddleware\Zed\Process\Business\Translator\Dictionary\AbstractDictionary;

class AntelopeDictionary extends AbstractDictionary
{
    /**
     * @return array
     */
    public function getDictionary(): array
    {
        return [
            'color' => 'GreyToPink',
        ];
    }
}
