<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\Computop\Business\Payment\Handler\Saver\Init;

use Generated\Shared\Transfer\ComputopCreditCardInitResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class CreditCardResponseSaver extends AbstractResponseSaver
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return void
     */
    public function handle(QuoteTransfer $quoteTransfer)
    {
        $responseTransfer = $quoteTransfer->getPayment()->getComputopCreditCard()->getCreditCardInitResponse();

        $this->handleDatabaseTransaction(function () use ($responseTransfer) {
            $this->saveComputopDetails($responseTransfer);
            $this->triggerEvent($this->getPaymentEntity($responseTransfer->getHeader()->getTransId()));
        });
    }

    /**
     * @param \Generated\Shared\Transfer\ComputopCreditCardInitResponseTransfer $responseTransfer
     *
     * @return void
     */
    protected function saveComputopDetails(ComputopCreditCardInitResponseTransfer $responseTransfer)
    {
        if (!$responseTransfer->getHeader()->getIsSuccess()) {
            return;
        }

        /** @var \Orm\Zed\Computop\Persistence\SpyPaymentComputop $paymentEntity */
        $paymentEntity = $this->getPaymentEntity($responseTransfer->getHeader()->getTransId());

        $paymentEntity->setPayId($responseTransfer->getHeader()->getPayId());
        $paymentEntity->setXId($responseTransfer->getHeader()->getXId());
        $paymentEntity->save();

        $paymentEntityDetails = $paymentEntity->getSpyPaymentComputopDetail();
        $paymentEntityDetails->fromArray($responseTransfer->toArray());
        $paymentEntityDetails->save();
    }

    /**
     * @param \Orm\Zed\Computop\Persistence\SpyPaymentComputop $paymentEntity
     *
     * @return void
     */
    protected function triggerEvent($paymentEntity)
    {
        $orderItems = $this
            ->queryContainer
            ->getSpySalesOrderItemsById($paymentEntity->getFkSalesOrder())
            ->find();

        $this->omsFacade->triggerEvent(
            $this->config->getOmsAuthorizeEventName(),
            $orderItems,
            []
        );
    }
}
