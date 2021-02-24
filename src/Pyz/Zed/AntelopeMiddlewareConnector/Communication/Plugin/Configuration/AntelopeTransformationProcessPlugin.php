<?php

namespace Pyz\Zed\AntelopeMiddlewareConnector\Communication\Plugin\Configuration;

use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\Configuration\ProcessConfigurationPluginInterface;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\Iterator\ProcessIteratorPluginInterface;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\Log\MiddlewareLoggerConfigPluginInterface;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\InputStreamPluginInterface;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\OutputStreamPluginInterface;

/**
 * @method \Pyz\Zed\AntelopeMiddlewareConnector\Communication\AntelopeMiddlewareConnectorCommunicationFactory getFactory()
 */
class AntelopeTransformationProcessPlugin extends AbstractPlugin implements ProcessConfigurationPluginInterface
{
    protected const PROCESS_NAME = 'ANTELOPE_PROCESS';

    /**
     * @return string
     */
    public function getProcessName(): string
    {
        return static::PROCESS_NAME;
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\InputStreamPluginInterface
     */
    public function getInputStreamPlugin(): InputStreamPluginInterface
    {
        return $this->getFactory()
            ->getAntelopeInputStreamPlugin();
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\OutputStreamPluginInterface
     */
    public function getOutputStreamPlugin(): OutputStreamPluginInterface
    {
        return $this->getFactory()
            ->getAntelopeOutputStreamPlugin();
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Iterator\ProcessIteratorPluginInterface
     */
    public function getIteratorPlugin(): ProcessIteratorPluginInterface
    {
        return $this->getFactory()
            ->getAntelopeIteratorPlugin();
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\StagePluginInterface[]
     */
    public function getStagePlugins(): array
    {
        return $this->getFactory()
            ->getAntelopeStagePluginStack();
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Log\MiddlewareLoggerConfigPluginInterface
     */
    public function getLoggerPlugin(): MiddlewareLoggerConfigPluginInterface
    {
        return $this->getFactory()
            ->getAntelopeLoggerConfigPlugin();
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Hook\PreProcessorHookPluginInterface[]
     */
    public function getPreProcessorHookPlugins(): array
    {
        return [];
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Hook\PostProcessorHookPluginInterface[]
     */
    public function getPostProcessorHookPlugins(): array
    {
        return [];
    }
}
