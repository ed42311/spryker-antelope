<?php

namespace Pyz\Zed\AntelopeMiddlewareConnector\Business;

use Generated\Shared\Transfer\TranslatorConfigTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Pyz\Zed\AntelopeMiddlewareConnector\Business\AntelopeMiddlewareConnectorBusinessFactory getFactory()
 */
class AntelopeMiddlewareConnectorFacade extends AbstractFacade implements AntelopeMiddlewareConnectorFacadeInterface
{

    /**
     * @return \Generated\Shared\Transfer\TranslatorConfigTransfer;
     */
    public function getAntelopeTranslatorConfig(): TranslatorConfigTransfer
    {
        return $this->getFactory()
            ->createAntelopeDictionary()
            ->getTranslatorConfig();
    }

}
