<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImport\Business\Model\ProductConcrete\Writer;

use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class ProductConcreteWriterStep implements DataImportStepInterface
{
    /**
     * @var \Spryker\Zed\DataImportExtension\Dependency\Plugin\DataSetWriterPluginInterface[]
     */
    protected $datasetWriterPlugins;

    /**
     * @param \Spryker\Zed\DataImportExtension\Dependency\Plugin\DataSetWriterPluginInterface[] $datasetWriterPlugins
     */
    public function __construct(array $datasetWriterPlugins)
    {
        $this->datasetWriterPlugins = $datasetWriterPlugins;
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet)
    {
        foreach ($this->datasetWriterPlugins as $dataSetWriterPlugin) {
            $dataSetWriterPlugin->write($dataSet);
        }
    }
}
