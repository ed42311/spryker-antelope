<?php

namespace Pyz\Zed\ExampleProductMiddlewareConnector\Business;

use Generated\Shared\Transfer\MapperConfigTransfer;
use Generated\Shared\Transfer\ValidatorConfigTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Pyz\Zed\ExampleProductMiddlewareConnector\Business\ExampleProductMiddlewareConnectorBusinessFactory getFactory()
 */
class ExampleProductMiddlewareConnectorFacade extends AbstractFacade implements ExampleProductMiddlewareConnectorFacadeInterface
{
    /**
     * @return \Generated\Shared\Transfer\MapperConfigTransfer
     */
    public function getProductConcreteImportMapperConfig(): MapperConfigTransfer
    {
        return $this->getFactory()
            ->createProductConcreteImportMap()
            ->getMapperConfig();
    }

    /**
     * @return \Generated\Shared\Transfer\ValidatorConfigTransfer
     */
    public function getProductConcreteImportValidatorConfig(): ValidatorConfigTransfer
    {
        return $this->getFactory()
            ->createProductConcreteImportValidator()
            ->getValidatorConfig();
    }
}
