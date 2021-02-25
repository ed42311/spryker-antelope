<?php


namespace Pyz\Zed\DataImport\Communication\Plugin\ExampleProductMiddlewareConnector;

use Pyz\Zed\ExampleProductMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \Pyz\Zed\DataImport\Business\DataImportFacadeInterface getFacade()
 * @method \Spryker\Zed\DataImport\DataImportConfig getConfig()
 */
class ExampleProductImporterPlugin extends AbstractPlugin implements DataImporterPluginInterface
{
    /**
     * @param array $data
     *
     * @return void
     */
    public function import(array $data): void
    {
        $this->getFacade()->importExampleProducts($data);
    }
}
