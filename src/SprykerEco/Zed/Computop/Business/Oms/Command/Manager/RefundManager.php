<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\Computop\Business\Oms\Command\Manager;

use Generated\Shared\Transfer\OrderTransfer;
use Propel\Runtime\Collection\ObjectCollection;

class RefundManager extends AbstractManager
{
    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return int
     */
    public function getAmount(OrderTransfer $orderTransfer): int
    {
        $totalsTransfer = $orderTransfer->getTotalsOrFail();

        if ($this->config->isRefundShipmentPriceEnabled() && $this->isShipmentRefundNeeded($orderTransfer)) {
            return $totalsTransfer->getRefundTotal();
        }

        return $totalsTransfer->getSubtotal() - $totalsTransfer->getDiscountTotal();
    }

    /**
     * Check is last refund
     *
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return bool
     */
    protected function isShipmentRefundNeeded(OrderTransfer $orderTransfer): bool
    {
        $itemsBeforeRefundState = count($this->getItemsBeforeRefundState($orderTransfer));

        $itemsToRefundCount = count($orderTransfer->getItems());

        return ($itemsBeforeRefundState - $itemsToRefundCount) === 0;
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Propel\Runtime\Collection\ObjectCollection|\Orm\Zed\Sales\Persistence\SpySalesOrderItem[]
     */
    protected function getItemsBeforeRefundState(OrderTransfer $orderTransfer): ObjectCollection
    {
        return $this
            ->queryContainer
            ->getSpySalesOrderItemsById($orderTransfer->getIdSalesOrderOrFail())
            ->useStateQuery()
            ->filterByName_In(
                (array)$this->config->getBeforeRefundStatuses(),
            )
            ->endUse()
            ->find();
    }
}
