<?php

namespace Pyz\Zed\ExampleProductMiddlewareConnector\Business;

use Generated\Shared\Transfer\MapperConfigTransfer;
use Generated\Shared\Transfer\ValidatorConfigTransfer;

/**
 * @method \Pyz\Zed\ExampleProductMiddlewareConnector\Business\ExampleProductMiddlewareConnectorBusinessFactory getFactory()
 */
interface ExampleProductMiddlewareConnectorFacadeInterface
{
    /**
     * @return \Generated\Shared\Transfer\MapperConfigTransfer
     */
    public function getProductConcreteImportMapperConfig(): MapperConfigTransfer;

    /**
     * @return \Generated\Shared\Transfer\ValidatorConfigTransfer
     */
    public function getProductConcreteImportValidatorConfig(): ValidatorConfigTransfer;
}
