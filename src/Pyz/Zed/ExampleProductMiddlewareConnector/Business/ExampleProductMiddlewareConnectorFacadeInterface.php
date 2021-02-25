<?php

namespace Pyz\Zed\ExampleProductMiddlewareConnector\Business;

use Generated\Shared\Transfer\TranslatorConfigTransfer;

/**
 * @method \Pyz\Zed\ExampleProductMiddlewareConnector\Business\ExampleProductMiddlewareConnectorBusinessFactory getFactory()
 */
interface ExampleProductMiddlewareConnectorFacadeInterface
{

    /**
     * @return \Generated\Shared\Transfer\TranslatorConfigTransfer;
     */
    public function getExampleProductTranslatorConfig(): TranslatorConfigTransfer;

}
