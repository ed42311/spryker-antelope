<?php

namespace Pyz\Zed\Antelope\Business\Antelope;

use Generated\Shared\Transfer\AntelopeErrorTransfer;
use Generated\Shared\Transfer\AntelopeResponseTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Orm\Zed\Antelope\Persistence\PyzAntelope;
use Pyz\Zed\Antelope\Business\Exception\AntelopeNotFoundException;
use Pyz\Zed\Antelope\Persistence\AntelopeQueryContainerInterface;

class Antelope implements AntelopeInterface
{
    /**
     * @var \Spryker\Zed\Antelope\Persistence\AntelopeQueryContainerInterface
     */
    protected $queryContainer;

    /**
     * @var \Spryker\Zed\Antelope\Business\AntelopeExpander\AntelopeExpanderInterface
     */
    protected $AntelopeExpander;

    /**
     * @param \Spryker\Zed\Antelope\Persistence\AntelopeQueryContainerInterface $queryContainer
     * @param \Spryker\Zed\Antelope\Business\ReferenceGenerator\AntelopeReferenceGeneratorInterface $AntelopeReferenceGenerator
     * @param \Spryker\Zed\Antelope\AntelopeConfig $AntelopeConfig
     * @param \Spryker\Zed\Antelope\Business\AntelopeExpander\AntelopeExpanderInterface $AntelopeExpander
     */
    public function __construct(AntelopeQueryContainerInterface $queryContainer) {
        $this->queryContainer = $queryContainer;
    }

    /**
     * @param \Generated\Shared\Transfer\AntelopeTransfer $AntelopeTransfer
     *
     * @return \Generated\Shared\Transfer\AntelopeTransfer
     */
    public function get(AntelopeTransfer $AntelopeTransfer): AntelopeTransfer
    {
        $AntelopeEntity = $this->getAntelope($AntelopeTransfer);
        $AntelopeTransfer->fromArray($AntelopeEntity->toArray(), true);

        $AntelopeTransfer = $this->AntelopeExpander->expand($AntelopeTransfer);

        return $AntelopeTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\AntelopeTransfer $AntelopeTransfer
     *
     * @return \Generated\Shared\Transfer\AntelopeResponseTransfer
     */
    public function add($AntelopeTransfer): AntelopeResponseTransfer
    {
        $AntelopeEntity = new PyzAntelope();
        $AntelopeEntity->fromArray($AntelopeTransfer->toArray());

        $AntelopeResponseTransfer = $this->createAntelopeResponseTransfer();
        if ($AntelopeResponseTransfer->getIsSuccess() !== true) {
            return $AntelopeResponseTransfer;
        }

        $AntelopeEntity->setAntelopeReference($this->AntelopeReferenceGenerator->generateAntelopeReference($AntelopeTransfer));

        $AntelopeEntity->save();

        $AntelopeTransfer->setIdAntelope($AntelopeEntity->getPrimaryKey());
        $AntelopeTransfer->setCreatedAt($AntelopeEntity->getCreatedAt()->format('Y-m-d H:i:s.u'));
        $AntelopeTransfer->setUpdatedAt($AntelopeEntity->getUpdatedAt()->format('Y-m-d H:i:s.u'));

        $AntelopeResponseTransfer
            ->setIsSuccess(true)
            ->setAntelopeTransfer($AntelopeTransfer);

        return $AntelopeResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\AntelopeTransfer $AntelopeTransfer
     *
     * @return bool
     */
    public function delete(AntelopeTransfer $AntelopeTransfer): bool
    {
        $AntelopeEntity = $this->getAntelope($AntelopeTransfer);
        $AntelopeEntity->delete();

        return true;
    }

    /**
     * @param \Generated\Shared\Transfer\AntelopeTransfer $AntelopeTransfer
     *
     * @return \Generated\Shared\Transfer\AntelopeResponseTransfer
     */
    public function update(AntelopeTransfer $AntelopeTransfer): AntelopeResponseTransfer
    {

        $AntelopeResponseTransfer = $this->createAntelopeResponseTransfer();
        $AntelopeResponseTransfer->setAntelopeTransfer($AntelopeTransfer);

        $AntelopeEntity = $this->getAntelope($AntelopeTransfer);
        $AntelopeEntity->fromArray($AntelopeTransfer->modifiedToArray());


        if (!$AntelopeResponseTransfer->getIsSuccess()) {
            return $AntelopeResponseTransfer;
        }

        if (!$AntelopeEntity->isModified()) {
            return $AntelopeResponseTransfer;
        }

        $AntelopeEntity->save();

        return $AntelopeResponseTransfer;
    }

    /**
     * @param bool $isSuccess
     *
     * @return \Generated\Shared\Transfer\AntelopeResponseTransfer
     */
    protected function createAntelopeResponseTransfer($isSuccess = true): AntelopeResponseTransfer
    {
        $AntelopeResponseTransfer = new AntelopeResponseTransfer();
        $AntelopeResponseTransfer->setIsSuccess($isSuccess);

        return $AntelopeResponseTransfer;
    }

    /**
     * @param string $message
     *
     * @return \Generated\Shared\Transfer\AntelopeErrorTransfer
     */
    protected function createErrorAntelopeResponseTransfer($message): AntelopeResponseTransfer
    {
        $AntelopeErrorTransfer = new AntelopeErrorTransfer();
        $AntelopeErrorTransfer->setMessage($message);

        return $AntelopeErrorTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\AntelopeTransfer $AntelopeTransfer
     *
     * @throws \Pyz\Zed\Antelope\Business\Exception\AntelopeNotFoundException
     *
     * @return \Orm\Zed\Antelope\Persistence\PyzAntelope
     */
    protected function getAntelope(AntelopeTransfer $AntelopeTransfer): PyzAntelope
    {
        $AntelopeEntity = null;

        if ($AntelopeTransfer->getIdAntelope()) {
            $AntelopeEntity = $this->queryContainer->queryAntelopeById($AntelopeTransfer->getIdAntelope())
                ->findOne();
        }

        if ($AntelopeEntity !== null) {
            return $AntelopeEntity;
        }

        throw new AntelopeNotFoundException(sprintf(
            'Antelope not found by either ID `%s`, email `%s` or restore password key `%s`.',
            $AntelopeTransfer->getIdAntelope(),
        ));
    }


    /**
     * @param \Generated\Shared\Transfer\AntelopeTransfer $AntelopeTransfer $AntelopeTransfer
     *
     * @return \Generated\Shared\Transfer\AntelopeTransfer|null
     */
    public function findById($AntelopeTransfer)
    {
        $AntelopeTransfer->requireIdAntelope();

        $AntelopeEntity = $this->queryContainer->queryAntelopeById($AntelopeTransfer->getIdAntelope())
            ->findOne();
        if ($AntelopeEntity === null) {
            return null;
        }

        $AntelopeTransfer = $this->hydrateAntelopeTransferFromEntity($AntelopeTransfer, $AntelopeEntity);

        return $AntelopeTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\AntelopeTransfer $AntelopeTransfer
     * @param \Orm\Zed\Antelope\Persistence\PyzAntelope $AntelopeEntity
     *
     * @return \Generated\Shared\Transfer\AntelopeTransfer
     */
    protected function hydrateAntelopeTransferFromEntity(
        AntelopeTransfer $AntelopeTransfer,
        PyzAntelope $AntelopeEntity
    ) {
        $AntelopeTransfer->fromArray($AntelopeEntity->toArray(), true);

        return $AntelopeTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\AntelopeResponseTransfer $AntelopeResponseTransfer
     * @param string $message
     *
     * @return \Generated\Shared\Transfer\AntelopeResponseTransfer
     */
    protected function addErrorToAntelopeResponseTransfer(AntelopeResponseTransfer $AntelopeResponseTransfer, string $message): AntelopeResponseTransfer
    {
        $AntelopeResponseTransfer->setIsSuccess(false);
        $AntelopeResponseTransfer->addError(
            $this->createErrorAntelopeResponseTransfer($message)
        );

        return $AntelopeResponseTransfer;
    }
}
