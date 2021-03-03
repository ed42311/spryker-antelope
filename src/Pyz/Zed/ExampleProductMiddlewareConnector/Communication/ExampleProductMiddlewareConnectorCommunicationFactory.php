<?php

namespace Pyz\Zed\ExampleProductMiddlewareConnector\Communication;

use Pyz\Zed\ExampleProductMiddlewareConnector\Business\Stream\DataImportWriteStream;
use Pyz\Zed\ExampleProductMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface;
use Pyz\Zed\ExampleProductMiddlewareConnector\ExampleProductMiddlewareConnectorDependencyProvider;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use SprykerMiddleware\Shared\Process\Stream\WriteStreamInterface;
use SprykerMiddleware\Zed\Process\Business\ProcessFacadeInterface;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\Iterator\ProcessIteratorPluginInterface;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\Log\MiddlewareLoggerConfigPluginInterface;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\InputStreamPluginInterface;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\OutputStreamPluginInterface;


/**
 * @method \Pyz\Zed\ExampleProductMiddlewareConnector\Persistence\ExampleProductMiddlewareConnectorQueryContainer getQueryContainer()
 * @method \Pyz\Zed\ExampleProductMiddlewareConnector\ExampleProductMiddlewareConnectorConfig getConfig()
 */
class ExampleProductMiddlewareConnectorCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \SprykerMiddleware\Shared\Process\Stream\WriteStreamInterface
     */
    public function createProductConcreteWriteStream(): WriteStreamInterface
    {
        return new DataImportWriteStream($this->getProductConcreteImporterPlugin());
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Business\ProcessFacadeInterface
     */
    public function getProcessFacade(): ProcessFacadeInterface
    {
        return $this->getProvidedDependency(ExampleProductMiddlewareConnectorDependencyProvider::FACADE_PROCESS);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\InputStreamPluginInterface
     */
    public function getProductConcreteInputStreamPlugin(): InputStreamPluginInterface
    {
        return $this->getProvidedDependency(ExampleProductMiddlewareConnectorDependencyProvider::EXAMPLE_PRODUCT_INPUT_STREAM_PLUGIN);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\OutputStreamPluginInterface
     */
    public function getProductConcreteOutputStreamPlugin(): OutputStreamPluginInterface
    {
        return $this->getProvidedDependency(ExampleProductMiddlewareConnectorDependencyProvider::EXAMPLE_PRODUCT_OUTPUT_STREAM_PLUGIN);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Iterator\ProcessIteratorPluginInterface
     */
    public function getProductConcreteIteratorPlugin(): ProcessIteratorPluginInterface
    {
        return $this->getProvidedDependency(ExampleProductMiddlewareConnectorDependencyProvider::EXAMPLE_PRODUCT_ITERATOR_PLUGIN);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Log\MiddlewareLoggerConfigPluginInterface
     */
    public function getProductConcreteLoggerConfigPlugin(): MiddlewareLoggerConfigPluginInterface
    {
        return $this->getProvidedDependency(ExampleProductMiddlewareConnectorDependencyProvider::EXAMPLE_PRODUCT_LOGGER_PLUGIN);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\StagePluginInterface[]
     */
    public function getProductConcreteStagePluginStack(): array
    {
        return $this->getProvidedDependency(ExampleProductMiddlewareConnectorDependencyProvider::EXAMPLE_PRODUCT_STAGE_PLUGIN_STACK);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Configuration\ProcessConfigurationPluginInterface[]
     */
    public function getProductConcreteProcesses(): array
    {
        return $this->getProvidedDependency(ExampleProductMiddlewareConnectorDependencyProvider::EXAMPLE_PRODUCT_PROCESSES);
    }

    /**
     * @return \Pyz\Zed\ExampleProductMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface
     */
    public function getProductConcreteImporterPlugin(): DataImporterPluginInterface
    {
        return $this->getProvidedDependency(ExampleProductMiddlewareConnectorDependencyProvider::EXAMPLE_PRODUCT_IMPORTER_PLUGIN);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Validator\ValidatorPluginInterface[]
     */
    public function getProductConcreteValidatorPluginStack(): array
    {
        return $this->getProvidedDependency(ExampleProductMiddlewareConnectorDependencyProvider::EXAMPLE_PRODUCT_IMPORTER_VALIDATOR_PLUGIN_STACK);
    }
}
