<?php

namespace Pyz\Zed\Antelope\Business\Antelope;

use Generated\Shared\Transfer\AntelopeResponseTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;

interface AntelopeInterface
{
    /**
     * @param \Generated\Shared\Transfer\AntelopeTransfer $AntelopeTransfer
     *
     * @return \Generated\Shared\Transfer\AntelopeTransfer
     */
    public function get(AntelopeTransfer $AntelopeTransfer): AntelopeTransfer;

    /**
     * @param \Generated\Shared\Transfer\AntelopeTransfer $AntelopeTransfer
     *
     * @return bool
     */
    public function delete(AntelopeTransfer $AntelopeTransfer): bool;

    /**
     * @param \Generated\Shared\Transfer\AntelopeTransfer $AntelopeTransfer
     *
     * @return \Generated\Shared\Transfer\AntelopeResponseTransfer
     */
    public function add($AntelopeTransfer): AntelopeResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\AntelopeTransfer $AntelopeTransfer
     *
     * @return \Generated\Shared\Transfer\AntelopeResponseTransfer
     */
    public function update(AntelopeTransfer $AntelopeTransfer): AntelopeResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\AntelopeTransfer $AntelopeTransfer $AntelopeTransfer
     *
     * @return \Generated\Shared\Transfer\AntelopeTransfer|null
     */
    public function findById($AntelopeTransfer);
}
