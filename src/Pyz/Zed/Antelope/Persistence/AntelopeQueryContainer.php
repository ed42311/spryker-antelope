<?php

namespace Pyz\Zed\Antelope\Persistence;

use Orm\Zed\Antelope\Persistence\PyzAntelopeQuery;
use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;

/**
 * @method \Pyz\Zed\Antelope\Persistence\AntelopePersistenceFactory getFactory()
 */
class AntelopeQueryContainer extends AbstractQueryContainer implements AntelopeQueryContainerInterface
{
    /**
     * @return \Orm\Zed\Antelope\Persistence\PyzAntelopeQuery
     */
    public function queryAntelopes(): PyzAntelopeQuery
    {
        return $this->getFactory()->createPyzAntelopeQuery();
    }

    /**
     * @api
     *
     * @inheritDoc
     */
    public function queryAntelopeById($id)
    {
        $query = $this->queryAntelopes();
        $query->filterByIdAntelope($id);

        return $query;
    }
}
