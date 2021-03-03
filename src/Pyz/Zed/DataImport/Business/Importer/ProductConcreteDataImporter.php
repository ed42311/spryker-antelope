<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImport\Business\Importer;

use Pyz\Zed\ExampleProductImport\Business\Importer\DataImporterInterface;
use Pyz\Zed\ExampleProductMiddlewareConnector\Business\Mapper\Map\ProductConcreteImportMap;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetStepBrokerInterface;
use Spryker\Zed\DataImport\Business\Model\Publisher\DataImporterPublisherInterface;
use Spryker\Zed\EventBehavior\EventBehaviorConfig;

class ProductConcreteDataImporter implements DataImporterInterface
{
    /**
     * @var \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetStepBrokerInterface
     */
    private $dataSetStepBroker;

    /**
     * @var \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface
     */
    private $dataSet;

    /**
     * @var \Spryker\Zed\DataImport\Business\Model\Publisher\DataImporterPublisherInterface
     */
    private $dataImporterPublisher;

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\Publisher\DataImporterPublisherInterface $dataImporterPublisher
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetStepBrokerInterface $dataSetStepBroker
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     */
    public function __construct(
        DataImporterPublisherInterface $dataImporterPublisher,
        DataSetStepBrokerInterface $dataSetStepBroker,
        DataSetInterface $dataSet
    ) {
        $this->dataImporterPublisher = $dataImporterPublisher;
        $this->dataSetStepBroker = $dataSetStepBroker;
        $this->dataSet = $dataSet;
    }

    public function import(array $data): void
    {
        EventBehaviorConfig::disableEvent();

        foreach ($data[ProductConcreteImportMap::ROOT_PRODUCT_CONCRETE_KEY] as $item) {
            $this->dataSet->exchangeArray($item);
            $this->dataSetStepBroker->execute($this->dataSet);
        }

        EventBehaviorConfig::enableEvent();
        $this->dataImporterPublisher->triggerEvents();
    }
}
