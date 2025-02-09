<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\Computop\Business\Oms\Command\Manager;

use Generated\Shared\Transfer\OrderTransfer;
use Propel\Runtime\Collection\ObjectCollection;

interface CancelManagerInterface
{
    /**
     * @param array $orderItems
     *
     * @return array
     */
    public function changeComputopItemsStatus(array $orderItems): array;

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Propel\Runtime\Collection\ObjectCollection
     */
    public function getCanceledItems(OrderTransfer $orderTransfer): ObjectCollection;
}
