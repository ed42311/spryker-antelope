<?php

namespace Pyz\Zed\Process;

use Pyz\Zed\AntelopeMiddlewareConnector\Communication\Plugin\Configuration\AntelopeMiddlewareConnectorConfigurationProfilePlugin;
use SprykerMiddleware\Zed\Process\ProcessDependencyProvider as SprykerProcessDependencyProvider;

class ProcessDependencyProvider extends SprykerProcessDependencyProvider
{
    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Configuration\ConfigurationProfilePluginInterface[]
     */
    protected function getConfigurationProfilePluginsStack(): array
    {
        return [
            new AntelopeMiddlewareConnectorConfigurationProfilePlugin(),
        ];
    }
}
