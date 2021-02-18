<?php

namespace Pyz\Zed\Antelope\Persistence;

use Orm\Zed\Antelope\Persistence\PyzAntelopeQuery;
use Spryker\Zed\Kernel\Persistence\QueryContainer\QueryContainerInterface;

interface AntelopeQueryContainerInterface extends QueryContainerInterface
{
    /**
     * @return \Orm\Zed\Antelope\Persistence\PyzAntelopeQuery
     */
    public function queryAntelopes(): PyzAntelopeQuery;


    /**
     * @api
     *
     * @param int $id
     *
     * @return \Orm\Zed\Customer\Persistence\PyzAntelopeQuery
     */
    public function queryAntelopeById($id);
}
