<?php


namespace Pyz\Zed\ExampleProductMiddlewareConnector\Business;

use Pyz\Zed\ExampleProductMiddlewareConnector\Business\Validator\ValidationRuleSet\ProductConcreteImportValidator;
use Pyz\Zed\ExampleProductMiddlewareConnector\Business\Mapper\Map\ProductConcreteImportMap;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use SprykerMiddleware\Zed\Process\Business\Mapper\Map\MapInterface;
use SprykerMiddleware\Zed\Process\Business\Validator\ValidationRuleSet\ValidationRuleSetInterface;

class ExampleProductMiddlewareConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \SprykerMiddleware\Zed\Process\Business\Mapper\Map\MapInterface
     */
    public function createProductConcreteImportMap(): MapInterface
    {
        return new ProductConcreteImportMap();
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Business\Validator\ValidationRuleSet\ValidationRuleSetInterface
     */
    public function createProductConcreteImportValidator(): ValidationRuleSetInterface
    {
        return new ProductConcreteImportValidator();
    }
}
