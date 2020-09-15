<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\Computop\Communication\Plugin\Oms\Command;

use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;
use Spryker\Zed\Oms\Dependency\Plugin\Command\CommandByOrderInterface;

/**
 * @method \SprykerEco\Zed\Computop\Business\ComputopFacadeInterface getFacade()
 */
class RefundPlugin extends AbstractComputopPlugin implements CommandByOrderInterface
{
    /**
     * {@inheritDoc}
     *  - Executes Refund command and performs Refund API call.
     *
     * @api
     *
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem[] $orderItems
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $orderEntity
     * @param \Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject $data
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function run(array $orderItems, SpySalesOrder $orderEntity, ReadOnlyArrayObject $data)
    {
        $orderEntity->getItems()->setData($orderItems);
        $orderTransfer = $this->getOrderTransfer($orderEntity);

        return $this
            ->getFacade()
            ->refundCommandHandle($orderItems, $orderTransfer);
    }
}
