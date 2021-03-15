<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\StockDataImport\Business\Writer;

use Orm\Zed\Stock\Persistence\SpyStock;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;
use Spryker\Zed\StockDataImport\Business\Writer\StockWriterStep as SprykerStockWriterStep;
use Pyz\Zed\StockDataImport\Business\Writer\DataSet\StockDataSetInterface;

class StockWriterStep extends SprykerStockWriterStep implements DataImportStepInterface
{
    /**
     * @param \Orm\Zed\Stock\Persistence\SpyStock $stockEntity
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    protected function saveStock(SpyStock $stockEntity, DataSetInterface $dataSet): void
    {
        $stockEntity->setName($dataSet[StockDataSetInterface::COLUMN_NAME])
            ->setErpId($dataSet[StockDataSetInterface::COLUMN_ERP_ID])
            ->setPimId($dataSet[StockDataSetInterface::COLUMN_PIM_ID])
            ->setIsActive($dataSet[StockDataSetInterface::COLUMN_IS_ACTIVE])
            ->save();
    }
}