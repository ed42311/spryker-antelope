<?php

namespace Pyz\Zed\AntelopeMiddlewareConnector\Communication\Plugin\Configuration;

use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\Configuration\ConfigurationProfilePluginInterface;

/**
 * @method \Pyz\Zed\AntelopeMiddlewareConnector\Communication\AntelopeMiddlewareConnectorCommunicationFactory getFactory()
 * @method \Pyz\Zed\AntelopeMiddlewareConnector\Business\AntelopeMiddlewareConnectorFacadeInterface getFacade()
 */
class AntelopeMiddlewareConnectorConfigurationProfilePlugin extends AbstractPlugin implements ConfigurationProfilePluginInterface
{
    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Configuration\ProcessConfigurationPluginInterface[]
     */
    public function getProcessConfigurationPlugins(): array
    {
        return $this->getFactory()
            ->getAntelopeProcesses();
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\TranslatorFunction\TranslatorFunctionPluginInterface[]
     */
    public function getTranslatorFunctionPlugins(): array
    {
        return $this->getFactory()
            ->getAntelopeTranslatorFunctions();
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Validator\ValidatorPluginInterface[]
     */
    public function getValidatorPlugins(): array
    {
        return [];
    }
}
