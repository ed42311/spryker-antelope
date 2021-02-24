<?php

namespace Pyz\Zed\AntelopeMiddlewareConnector;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;
use Pyz\Zed\AntelopeMiddlewareConnector\Communication\Plugin\AntelopeTranslationStagePlugin;
use Pyz\Zed\AntelopeMiddlewareConnector\Communication\Plugin\Configuration\AntelopeTransformationProcessPlugin;
use Pyz\Zed\AntelopeMiddlewareConnector\Communication\Plugin\TranslatorFunction\GreyToPinkTranslatorFunctionPlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\Iterator\NullIteratorPlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\Log\MiddlewareLoggerConfigPlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\Stream\JsonRowInputStreamPlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\Stream\JsonRowOutputStreamPlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\StreamReaderStagePlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\StreamWriterStagePlugin;

class AntelopeMiddlewareConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    public const ANTELOPE_MIDDLEWARE_TRANSLATOR_FUNCTIONS = 'ANTELOPE_MIDDLEWARE_TRANSLATOR_FUNCTIONS';
    public const ANTELOPE_MIDDLEWARE_PROCESSES = 'ANTELOPE_MIDDLEWARE_PROCESSES';
    public const ANTELOPE_INPUT_STREAM_PLUGIN = 'ANTELOPE_INPUT_STREAM_PLUGIN';
    public const ANTELOPE_OUTPUT_STREAM_PLUGIN = 'ANTELOPE_OUTPUT_STREAM_PLUGIN';
    public const ANTELOPE_ITERATOR_PLUGIN = 'ANTELOPE_ITERATOR_PLUGIN';
    public const ANTELOPE_STAGE_PLUGIN_STACK = 'ANTELOPE_STAGE_PLUGIN_STACK';
    public const ANTELOPE_LOGGER_PLUGIN = 'ANTELOPE_LOGGER_PLUGIN';
    public const FACADE_PROCESS = 'FACADE_PROCESS';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container)
    {
        $container = $this->addFacadeProcess($container);
        $container = $this->addAntelopeTransformationProcessPlugins($container);
        $container = $this->addAntelopeProcesses($container);
        $container = $this->addAntelopeTranslatorFunctionsPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container)
    {
        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addFacadeProcess(Container $container): Container
    {
        $container[static::FACADE_PROCESS] = function (Container $container) {
            return $container->getLocator()->process()->facade();
        };
        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addAntelopeTransformationProcessPlugins(Container $container): Container
    {
        $container[static::ANTELOPE_INPUT_STREAM_PLUGIN] = function () {
            return new JsonRowInputStreamPlugin();
        };
        $container[static::ANTELOPE_OUTPUT_STREAM_PLUGIN] = function () {
            return new JsonRowOutputStreamPlugin();
        };
        $container[static::ANTELOPE_ITERATOR_PLUGIN] = function () {
            return new NullIteratorPlugin();
        };
        $container[static::ANTELOPE_STAGE_PLUGIN_STACK] = function () {
            return [
                new StreamReaderStagePlugin(),
                new AntelopeTranslationStagePlugin(),
                new StreamWriterStagePlugin(),
            ];
        };
        $container[static::ANTELOPE_LOGGER_PLUGIN] = function () {
            return new MiddlewareLoggerConfigPlugin();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addAntelopeTranslatorFunctionsPlugins($container): Container
    {
        $container[static::ANTELOPE_MIDDLEWARE_TRANSLATOR_FUNCTIONS] = function () {
            return $this->getAntelopeTranslatorFunctionPlugins();
        };
        return $container;
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Validator\GenericValidatorPluginInterface[]
     */
    public function getAntelopeTranslatorFunctionPlugins(): array
    {
        return [
            new GreyToPinkTranslatorFunctionPlugin(),
        ];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addAntelopeProcesses(Container $container): Container
    {
        $container[static::ANTELOPE_MIDDLEWARE_PROCESSES] = function () {
            return $this->getAntelopeProcesses();
        };
        return $container;
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Configuration\ProcessConfigurationPluginInterface[]
     */
    protected function getAntelopeProcesses(): array
    {
        return [
            new AntelopeTransformationProcessPlugin(),
        ];
    }
}
