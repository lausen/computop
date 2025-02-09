<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\Computop\Business\Oms\Command\Manager;

use Generated\Shared\Transfer\OrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Collection\ObjectCollection;

class CancelManager extends AbstractManager implements CancelManagerInterface
{
    /**
     * @param array $orderItems
     *
     * @return array
     */
    public function changeComputopItemsStatus(array $orderItems): array
    {
        $this->getTransactionHandler()->handleTransaction(
            function () use ($orderItems): void {
                foreach ($orderItems as $orderItem) {
                    $this->changeStatus($orderItem);
                }
            },
        );

        return [];
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Propel\Runtime\Collection\ObjectCollection|\Orm\Zed\Sales\Persistence\SpySalesOrderItem[]
     */
    public function getCanceledItems(OrderTransfer $orderTransfer): ObjectCollection
    {
        return $this
            ->queryContainer
            ->getSpySalesOrderItemsById($orderTransfer->getIdSalesOrderOrFail())
            ->useStateQuery()
            ->filterByName(
                $this->config->getOmsStatusCancelled(),
                Criteria::EQUAL,
            )
            ->endUse()
            ->find();
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $orderItem
     *
     * @return void
     */
    protected function changeStatus(SpySalesOrderItem $orderItem): void
    {
        $computopOrderItem = $this
            ->queryContainer
            ->queryPaymentItemByOrderItemId($orderItem->getIdSalesOrderItem())
            ->findOne();

        if (!$computopOrderItem) {
            return;
        }

        $computopOrderItem->setStatus($this->config->getOmsStatusCancelled());
        $computopOrderItem->save();
    }
}
