<?php

namespace Pyz\Zed\Antelope\Communication\Form\DataProvider;

use Pyz\Zed\Antelope\Communication\Form\AntelopeForm;

class AntelopeFormDataProvider extends AbstractAntelopeDataProvider
{
    /**
     * @var \Pyz\Zed\Antelope\Persistence\AntelopeQueryContainerInterface
     */
    protected $AntelopeQueryContainer;


    /**
     * @param \Pyz\Zed\Antelope\Persistence\AntelopeQueryContainerInterface $AntelopeQueryContainer
     */
    public function __construct($AntelopeQueryContainer)
    {
        $this->AntelopeQueryContainer = $AntelopeQueryContainer;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return [];
    }
}
