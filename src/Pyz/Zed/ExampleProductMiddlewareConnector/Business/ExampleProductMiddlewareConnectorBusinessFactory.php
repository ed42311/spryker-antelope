<?php

namespace Pyz\Zed\ExampleProductMiddlewareConnector\Business;

use Pyz\Zed\ExampleProductMiddlewareConnector\Business\Translator\Dictionary\ExampleProductDictionary;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use SprykerMiddleware\Zed\Process\Business\Translator\Dictionary\DictionaryInterface;

/**
 * @method \Pyz\Zed\ExampleProductMiddlewareConnector\ExampleProductMiddlewareConnectorConfig getConfig()
 * @method \Pyz\Zed\ExampleProductMiddlewareConnector\Persistence\ExampleProductMiddlewareConnectorQueryContainer getQueryContainer()
 */
class ExampleProductMiddlewareConnectorBusinessFactory extends AbstractBusinessFactory
{

    /**
     * @return \SprykerMiddleware\Zed\Process\Business\Translator\Dictionary\DictionaryInterface
     */
    public function createExampleProductDictionary(): DictionaryInterface
    {
        return new ExampleProductDictionary();
    }

}
