<?php

namespace Pyz\Zed\Antelope\Communication\Form\DataProvider;

use Pyz\Zed\Antelope\Communication\Form\AntelopeForm;
use Pyz\Zed\Antelope\Communication\Form\AntelopeUpdateForm;

class AntelopeUpdateFormDataProvider extends AntelopeFormDataProvider
{
    /**
     * @param int|null $idAntelope
     *
     * @return array
     */
    public function getData($idAntelope = null)
    {
        if ($idAntelope === null) {
            return parent::getData();
        }

        $AntelopeEntity = $this
            ->AntelopeQueryContainer
            ->queryAntelopeById($idAntelope)
            ->findOne();

        if ($AntelopeEntity === null) {
            return parent::getData();
        }

        $data = $AntelopeEntity->toArray();

        return $data;
    }
}
