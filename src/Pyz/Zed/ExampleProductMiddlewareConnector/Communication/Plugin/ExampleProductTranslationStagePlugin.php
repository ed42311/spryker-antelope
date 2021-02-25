<?php

namespace Pyz\Zed\ExampleProductMiddlewareConnector\Communication\Plugin;

use Generated\Shared\Transfer\TranslatorConfigTransfer;
use Pyz\Zed\ExampleProductMiddlewareConnector\Business\ExampleProductMiddlewareConnectorFacadeInterface;
use Pyz\Zed\ExampleProductMiddlewareConnector\Communication\ExampleProductMiddlewareConnectorCommunicationFactory;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use SprykerMiddleware\Shared\Process\Stream\WriteStreamInterface;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\StagePluginInterface;

/**
 * @method ExampleProductMiddlewareConnectorCommunicationFactory getFactory()
 * @method ExampleProductMiddlewareConnectorFacadeInterface getFacade()
 */
class ExampleProductTranslationStagePlugin extends AbstractPlugin implements StagePluginInterface
{
    protected const PLUGIN_NAME = 'ExampleProductTranslationStagePlugin';

    /**
     * @return \Generated\Shared\Transfer\TranslatorConfigTransfer
     */
    protected function getTranslatorConfig(): TranslatorConfigTransfer
    {
        return $this->getFacade()
            ->getExampleProductTranslatorConfig();
    }

    /**
     * @param mixed $payload
     * @param \SprykerMiddleware\Shared\Process\Stream\WriteStreamInterface $outStream
     * @param mixed $originalPayload
     *
     * @return mixed
     */
    public function process($payload, WriteStreamInterface $outStream, $originalPayload)
    {
        return $this->getFactory()
            ->getProcessFacade()
            ->translate($payload, $this->getTranslatorConfig());
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return static::PLUGIN_NAME;
    }
}