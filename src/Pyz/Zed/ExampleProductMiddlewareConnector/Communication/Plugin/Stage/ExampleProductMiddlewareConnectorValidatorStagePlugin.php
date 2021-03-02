<?php
namespace Pyz\Zed\ExampleProductMiddlewareConnector\Communication\Plugin\Stage;

use Generated\Shared\Transfer\ValidatorConfigTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use SprykerMiddleware\Shared\Process\Stream\WriteStreamInterface;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\StagePluginInterface;

/**
 * @method \Pyz\Zed\ExampleProductMiddlewareConnector\Communication\ExampleProductMiddlewareConnectorCommunicationFactory getFactory()
 * @method \Pyz\Zed\ExampleProductMiddlewareConnector\Business\ExampleProductMiddlewareConnectorFacadeInterface getFacade()
 */
class ExampleProductMiddlewareConnectorValidatorStagePlugin extends AbstractPlugin implements StagePluginInterface
{
    protected const PLUGIN_NAME = 'ExampleProductMiddlewareConnectorValidatorStagePlugin';

    /**
     * @api
     *
     * @return string
     */
    public function getName(): string
    {
        return static::PLUGIN_NAME;
    }

    /**
     * @api
     *
     * @param mixed $payload
     * @param \SprykerMiddleware\Shared\Process\Stream\WriteStreamInterface $outStream
     * @param mixed $originalPayload
     *
     * @return array|mixed
     */
    public function process($payload, WriteStreamInterface $outStream, $originalPayload)
    {
        return $this->getFactory()
            ->getProcessFacade()
            ->validate($payload, $this->getValidatorConfig());
    }

    /**
     * @return \Generated\Shared\Transfer\ValidatorConfigTransfer
     */
    protected function getValidatorConfig(): ValidatorConfigTransfer
    {
        return $this->getFacade()
            ->getProductConcreteImportValidatorConfig();
    }
}