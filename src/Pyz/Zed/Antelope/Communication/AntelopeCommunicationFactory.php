<?php

namespace Pyz\Zed\Antelope\Communication;

use Pyz\Zed\Antelope\Communication\Table\AntelopeTable;
use Pyz\Zed\Antelope\Communication\Form\AntelopeUpdateForm;
use Pyz\Zed\Antelope\Communication\Form\DataProvider\AntelopeUpdateFormDataProvider;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

/**
 * @method \Pyz\Zed\Antelope\Persistence\AntelopeQueryContainerInterface getQueryContainer()
 */
class AntelopeCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \Pyz\Zed\Antelope\Communication\Table\AntelopeTable
     */
    public function createAntelopeTable()
    {
        return new AntelopeTable(
            $this->getQueryContainer()
        );
    }

    /**
     * @param array $data
     * @param array $options
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function createAntelopeUpdateForm(array $data = [], array $options = [])
    {
        return $this->getFormFactory()->create(AntelopeUpdateForm::class, $data, $options);
    }

    /**
     * @return \Spryker\Zed\Customer\Communication\Form\DataProvider\AntelopeUpdateFormDataProvider
     */
    public function createAntelopeUpdateFormDataProvider()
    {
        return new AntelopeUpdateFormDataProvider($this->getQueryContainer());
    }
}
