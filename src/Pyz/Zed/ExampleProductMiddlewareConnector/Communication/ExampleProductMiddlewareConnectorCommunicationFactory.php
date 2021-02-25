<?php

namespace Pyz\Zed\ExampleProductMiddlewareConnector\Communication;

use Pyz\Zed\ExampleProductMiddlewareConnector\ExampleProductMiddlewareConnectorDependencyProvider;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use SprykerMiddleware\Zed\Process\Business\ProcessFacadeInterface;
use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\TranslatorFunctionInterface;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\Configuration\ProcessConfigurationPluginInterface;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\Iterator\ProcessIteratorPluginInterface;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\Log\MiddlewareLoggerConfigPluginInterface;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\StagePluginInterface;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\InputStreamPluginInterface;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\OutputStreamPluginInterface;

class ExampleProductMiddlewareConnectorCommunicationFactory extends AbstractCommunicationFactory
{

    public function getExampleProductInputStreamPlugin(): InputStreamPluginInterface
    {
        return $this->getProvidedDependency(ExampleProductMiddlewareConnectorDependencyProvider::EXAMPLE_PRODUCT_INPUT_STREAM_PLUGIN);
    }

    public function getExampleProductOutputStreamPlugin(): OutputStreamPluginInterface
    {
        return $this->getProvidedDependency(ExampleProductMiddlewareConnectorDependencyProvider::EXAMPLE_PRODUCT_OUTPUT_STREAM_PLUGIN);
    }

    public function getExampleProductIteratorPlugin(): ProcessIteratorPluginInterface
    {
        return $this->getProvidedDependency(ExampleProductMiddlewareConnectorDependencyProvider::EXAMPLE_PRODUCT_ITERATOR_PLUGIN);
    }

    public function getExampleProductLoggerConfigPlugin(): MiddlewareLoggerConfigPluginInterface
    {
        return $this->getProvidedDependency(ExampleProductMiddlewareConnectorDependencyProvider::EXAMPLE_PRODUCT_LOGGER_PLUGIN);
    }

    /**
     * @return StagePluginInterface[]
     */
    public function getExampleProductStagePluginStack(): array
    {
        return $this->getProvidedDependency(ExampleProductMiddlewareConnectorDependencyProvider::EXAMPLE_PRODUCT_STAGE_PLUGIN_STACK);
    }

    public function getProcessFacade(): ProcessFacadeInterface
    {
        return $this->getProvidedDependency(ExampleProductMiddlewareConnectorDependencyProvider::FACADE_PROCESS);
    }

    /**
     * @return TranslatorFunctionInterface[]
     */
    public function getExampleProductTranslatorFunctions(): array
    {
        return $this->getProvidedDependency(ExampleProductMiddlewareConnectorDependencyProvider::EXAMPLE_PRODUCT_MIDDLEWARE_TRANSLATOR_FUNCTIONS);
    }

    /**
     * @return ProcessConfigurationPluginInterface[]
     */
    public function getExampleProductProcesses(): array
    {
        return $this->getProvidedDependency(ExampleProductMiddlewareConnectorDependencyProvider::EXAMPLE_PRODUCT_MIDDLEWARE_PROCESSES);
    }
}
