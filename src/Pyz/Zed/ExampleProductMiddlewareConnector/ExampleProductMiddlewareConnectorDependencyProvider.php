<?php

namespace Pyz\Zed\ExampleProductMiddlewareConnector;

use Pyz\Zed\DataImport\Communication\Plugin\ExampleProductMiddlewareConnector\ExampleProductImporterPlugin;
use Pyz\Zed\ExampleProductMiddlewareConnector\Communication\Plugin\ExampleProductTranslationStagePlugin;
use Pyz\Zed\ExampleProductMiddlewareConnector\Communication\Plugin\Configuration\ExampleProductTransformationProcessPlugin;
use Pyz\Zed\ExampleProductMiddlewareConnector\Communication\Plugin\TranslatorFunction\GreyToMagentaTranslatorFunctionPlugin;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;
use SprykerMiddleware\Zed\Process\Communication\Plugin\Iterator\NullIteratorPlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\Log\MiddlewareLoggerConfigPlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\Stream\JsonRowInputStreamPlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\Stream\JsonRowOutputStreamPlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\StreamReaderStagePlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\StreamWriterStagePlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\Validator\NotBlankValidatorPlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\Validator\RequiredValidatorPlugin;

class ExampleProductMiddlewareConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    public const EXAMPLE_PRODUCT_MIDDLEWARE_TRANSLATOR_FUNCTIONS = 'EXAMPLE_PRODUCT_MIDDLEWARE_TRANSLATOR_FUNCTIONS';
    public const EXAMPLE_PRODUCT_MIDDLEWARE_PROCESSES = 'EXAMPLE_PRODUCT_MIDDLEWARE_PROCESSES';
    public const EXAMPLE_PRODUCT_INPUT_STREAM_PLUGIN = 'EXAMPLE_PRODUCT_INPUT_STREAM_PLUGIN';
    public const EXAMPLE_PRODUCT_OUTPUT_STREAM_PLUGIN = 'EXAMPLE_PRODUCT_OUTPUT_STREAM_PLUGIN';
    public const EXAMPLE_PRODUCT_ITERATOR_PLUGIN = 'EXAMPLE_PRODUCT_ITERATOR_PLUGIN';
    public const EXAMPLE_PRODUCT_STAGE_PLUGIN_STACK = 'EXAMPLE_PRODUCT_STAGE_PLUGIN_STACK';
    public const EXAMPLE_PRODUCT_IMPORTER_VALIDATOR_PLUGIN_STACK = 'EXAMPLE_PRODUCT_IMPORTER_VALIDATOR_PLUGIN_STACK';
    public const EXAMPLE_PRODUCT_LOGGER_PLUGIN = 'EXAMPLE_PRODUCT_LOGGER_PLUGIN';
    public const FACADE_PROCESS = 'FACADE_PROCESS';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container)
    {
        $container = $this->addFacadeProcess($container);
        $container = $this->addExampleProductTransformationProcessPlugins($container);
        $container = $this->addExampleProductProcesses($container);
        $container = $this->addExampleProductTranslatorFunctionsPlugins($container);
        $container = $this->addExampleProductValidatorPluginStack($container);

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
    protected function addExampleProductTransformationProcessPlugins(Container $container): Container
    {
        $container[static::EXAMPLE_PRODUCT_INPUT_STREAM_PLUGIN] = function () {
            return new JsonRowInputStreamPlugin();
        };
        $container[static::EXAMPLE_PRODUCT_OUTPUT_STREAM_PLUGIN] = function () {
            return new JsonRowOutputStreamPlugin();
        };
        $container[static::EXAMPLE_PRODUCT_ITERATOR_PLUGIN] = function () {
            return new NullIteratorPlugin();
        };
        $container[static::EXAMPLE_PRODUCT_STAGE_PLUGIN_STACK] = function () {
            return [
                new StreamReaderStagePlugin(),
                new ExampleProductTranslationStagePlugin(),
                new StreamWriterStagePlugin(),
            ];
        };
        $container[static::EXAMPLE_PRODUCT_LOGGER_PLUGIN] = function () {
            return new MiddlewareLoggerConfigPlugin();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addExampleProductTranslatorFunctionsPlugins($container): Container
    {
        $container[static::EXAMPLE_PRODUCT_MIDDLEWARE_TRANSLATOR_FUNCTIONS] = function () {
            return $this->getExampleProductTranslatorFunctionPlugins();
        };
        return $container;
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Validator\GenericValidatorPluginInterface[]
     */
    public function getExampleProductTranslatorFunctionPlugins(): array
    {
        return [
            new GreyToMagentaTranslatorFunctionPlugin(),
        ];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addExampleProductValidatorPluginStack(Container $container): Container
    {
        $container->set(static::EXAMPLE_PRODUCT_IMPORTER_VALIDATOR_PLUGIN_STACK, function () {
            return $this->getValidatorsStack();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addExampleProductProcesses(Container $container): Container
    {
        $container[static::EXAMPLE_PRODUCT_MIDDLEWARE_PROCESSES] = function () {
            return $this->getExampleProductProcesses();
        };
        return $container;
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Configuration\ProcessConfigurationPluginInterface[]
     */
    protected function getExampleProductProcesses(): array
    {
        return [
            new ExampleProductTransformationProcessPlugin(),
        ];
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Validator\ValidatorPluginInterface[]
     */
    protected function getValidatorsStack(): array
    {
        return [
            new NotBlankValidatorPlugin(),
            new RequiredValidatorPlugin(),
        ];
    }
}
