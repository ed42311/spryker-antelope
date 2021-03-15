<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\StockDataImport\Business\Writer\DataSet;

use Spryker\Zed\StockDataImport\Business\Writer\DataSet\StockDataSetInterface as SprykerStockDataSetInterface;

interface StockDataSetInterface extends SprykerStockDataSetInterface
{
    public const COLUMN_ERP_ID = 'erp_id';
    public const COLUMN_PIM_ID = 'pim_id';
}
