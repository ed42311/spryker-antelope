<?php

namespace Pyz\Zed\ExampleProductMiddlewareConnector;

use Pyz\Zed\DataImport\Communication\Plugin\ExampleProductMiddlewareConnector\ExampleProductImporterPlugin;
use Pyz\Zed\ExampleProductMiddlewareConnector\Communication\Plugin\Process\ExampleProductMiddlewareConnectorTransformationProcessPlugin;
use Pyz\Zed\ExampleProductMiddlewareConnector\Communication\Plugin\Stage\ExampleProductMiddlewareConnectorMapperStagePlugin;
use Pyz\Zed\ExampleProductMiddlewareConnector\Communication\Plugin\Stage\ExampleProductMiddlewareConnectorValidatorStagePlugin;
use Pyz\Zed\ExampleProductMiddlewareConnector\Communication\Plugin\Stream\ExampleProductMiddlewareConnectorOutputStreamPlugin;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;
use SprykerMiddleware\Zed\Process\Communication\Plugin\Iterator\NullIteratorPlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\Log\MiddlewareLoggerConfigPlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\Stream\XmlInputStreamPlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\StreamReaderStagePlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\StreamWriterStagePlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\Validator\NotBlankValidatorPlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\Validator\RequiredValidatorPlugin;

class ExampleProductMiddlewareConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_PROCESS = 'FACADE_PROCESS';
    public const FACADE_DATA_IMPORT = 'FACADE_DATA_IMPORT';
    public const EXAMPLE_PRODUCT_INPUT_STREAM_PLUGIN = 'EXAMPLE_PRODUCT_INPUT_STREAM_PLUGIN';
    public const EXAMPLE_PRODUCT_OUTPUT_STREAM_PLUGIN = 'EXAMPLE_PRODUCT_OUTPUT_STREAM_PLUGIN';
    public const EXAMPLE_PRODUCT_ITERATOR_PLUGIN = 'EXAMPLE_PRODUCT_ITERATOR_PLUGIN';
    public const EXAMPLE_PRODUCT_STAGE_PLUGIN_STACK = 'EXAMPLE_PRODUCT_STAGE_PLUGIN_STACK';
    public const EXAMPLE_PRODUCT_IMPORTER_VALIDATOR_PLUGIN_STACK = 'EXAMPLE_PRODUCT_IMPORTER_VALIDATOR_PLUGINS';
    public const EXAMPLE_PRODUCT_LOGGER_PLUGIN = 'EXAMPLE_PRODUCT_LOGGER_PLUGIN';
    public const EXAMPLE_PRODUCT_PROCESSES = 'EXAMPLE_PRODUCT_MIDDLEWARE_PROCESSES';
    public const EXAMPLE_PRODUCT_IMPORTER_PLUGIN = 'EXAMPLE_PRODUCT_IMPORTER_PLUGIN';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container)
    {
        $container = $this->addFacadeProcess($container);
        $container = $this->addProductConcreteProcesses($container);
        $container = $this->addProductConcreteInputStreamPlugin($container);
        $container = $this->addProductConcreteOutputStreamPlugin($container);
        $container = $this->addProductConcreteStageStackPlugin($container);
        $container = $this->addProductConcreteLoggerPlugin($container);
        $container = $this->addProductConcreteIteratorPlugin($container);
        $container = $this->addProductConcreteDataImporterPlugin($container);
        $container = $this->addProductConcreteValidatorPluginStack($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addFacadeProcess(Container $container): Container
    {
        $container->set(static::FACADE_PROCESS, function (Container $container) {
            return $container->getLocator()->process()->facade();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addProductConcreteInputStreamPlugin(Container $container): Container
    {
        $container->set(static::EXAMPLE_PRODUCT_INPUT_STREAM_PLUGIN, function () {
            return new XmlInputStreamPlugin();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addProductConcreteOutputStreamPlugin(Container $container): Container
    {
        $container->set(static::EXAMPLE_PRODUCT_OUTPUT_STREAM_PLUGIN, function () {
            return new ExampleProductMiddlewareConnectorOutputStreamPlugin();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addProductConcreteIteratorPlugin(Container $container): Container
    {
        $container->set(static::EXAMPLE_PRODUCT_ITERATOR_PLUGIN, function () {
            return new NullIteratorPlugin();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addProductConcreteStageStackPlugin(Container $container): Container
    {
        $container->set(static::EXAMPLE_PRODUCT_STAGE_PLUGIN_STACK, function () {
            return [
                new StreamReaderStagePlugin(),
                new ExampleProductMiddlewareConnectorValidatorStagePlugin(),
                new ExampleProductMiddlewareConnectorMapperStagePlugin(),
                new StreamWriterStagePlugin(),
            ];
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addProductConcreteLoggerPlugin(Container $container): Container
    {
        $container->set(static::EXAMPLE_PRODUCT_LOGGER_PLUGIN, function () {
            return new MiddlewareLoggerConfigPlugin();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addProductConcreteValidatorPluginStack(Container $container): Container
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
    public function addProductConcreteProcesses(Container $container): Container
    {
        $container->set(static::EXAMPLE_PRODUCT_PROCESSES, function () {
            return $this->getProductConcreteProcesses();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addProductConcreteDataImporterPlugin(Container $container): Container
    {
        $container->set(static::EXAMPLE_PRODUCT_IMPORTER_PLUGIN, function () {
            return new ExampleProductImporterPlugin();
        });

        return $container;
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Configuration\ProcessConfigurationPluginInterface[]
     */
    protected function getProductConcreteProcesses(): array
    {
        return [
            new ExampleProductMiddlewareConnectorTransformationProcessPlugin(),
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
