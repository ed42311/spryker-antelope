<?php

namespace Pyz\Zed\Antelope\Communication\Controller;

use Generated\Shared\Transfer\AntelopeTransfer;
use Pyz\Shared\Antelope\AntelopeConstants;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Pyz\Zed\Antelope\Business\AntelopeFacadeInterface getFacade()
 * @method \Pyz\Zed\Antelope\Communication\AntelopeCommunicationFactory getFactory()
 * @method \Pyz\Zed\Antelope\Persistence\AntelopeRepositoryInterface getRepository()
 * @method \Pyz\Zed\Antelope\Persistence\AntelopeQueryContainerInterface getQueryContainer()
 */
class EditController extends AbstractController
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function indexAction(Request $request)
    {
        // http://zed.de.spryker.local/antelope/edit?id-antelope=1
        $idAntelope = $this->castId($request->query->get(AntelopeConstants::PARAM_ID_ANTELOPE));

        if (empty($idAntelope)) {
            return $this->redirectResponse(AntelopeConstants::URL_ANTELOPE_LIST_PAGE);
        }

        $dataProvider = $this->getFactory()->createAntelopeUpdateFormDataProvider();
        $formData = $dataProvider->getData($idAntelope);

        if ($formData === []) {
            return $this->redirectResponse(AntelopeConstants::URL_ANTELOPE_LIST_PAGE);
        }

        $form = $this->getFactory()
            ->createAntelopeUpdateForm(
                $formData,
            )
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $antelopeTransfer = new AntelopeTransfer();
            $antelopeTransfer->fromArray($form->getData(), true);

            $AntelopeResponseTransfer = $this->getFacade()->updateAntelope($antelopeTransfer);
            //     if (!$AntelopeResponseTransfer->getIsSuccess()) {
            //         $this->addErrorMessage(static::MESSAGE_ANTELOPE_UPDATE_ERROR);

            //         return $this->viewResponse([
            //             'form' => $form->createView(),
            //             'idAntelope' => $idAntelope,
            //         ]);
            //     }

            return $this->redirectResponse(
                sprintf('/antelope/view?%s=%d', AntelopeConstants::PARAM_ID_ANTELOPE, $idAntelope)
            );
        }

        $idAntelope = $this->castId($idAntelope);

        $antelopeTransfer = $this->loadAntelopeTransfer($idAntelope);

        return $this->viewResponse([
            'form' => $form->createView(),
            'antelope' => $antelopeTransfer,
            'idAntelope' => $idAntelope,
        ]);
    }

    /**
     * @return \Generated\Shared\Transfer\AntelopeTransfer
     */
    protected function createAntelopeTransfer()
    {
        return new AntelopeTransfer();
    }

    /**
     * @param int $idAntelope
     *
     * @return \Generated\Shared\Transfer\AntelopeTransfer
     */
    protected function loadAntelopeTransfer($idAntelope)
    {
        $antelopeTransfer = $this->createAntelopeTransfer();
        $antelopeTransfer->setIdAntelope($idAntelope);
        $antelopeTransfer = $this->getFacade()->getAntelope($antelopeTransfer);

        return $antelopeTransfer;
    }
}
