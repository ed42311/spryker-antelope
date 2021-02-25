<?php

namespace Pyz\Zed\ExampleProductMiddlewareConnector\Business;

use Generated\Shared\Transfer\TranslatorConfigTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Pyz\Zed\ExampleProductMiddlewareConnector\Business\ExampleProductMiddlewareConnectorBusinessFactory getFactory()
 */
class ExampleProductMiddlewareConnectorFacade extends AbstractFacade implements ExampleProductMiddlewareConnectorFacadeInterface
{

    /**
     * @return \Generated\Shared\Transfer\TranslatorConfigTransfer;
     */
    public function getExampleProductTranslatorConfig(): TranslatorConfigTransfer
    {
        return $this->getFactory()
            ->createExampleProductDictionary()
            ->getTranslatorConfig();
    }

}
