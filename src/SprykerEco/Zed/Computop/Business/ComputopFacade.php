<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\Computop\Business;

use Generated\Shared\Transfer\CheckoutResponseTransfer;
use Generated\Shared\Transfer\ComputopHeaderPaymentTransfer;
use Generated\Shared\Transfer\ComputopResponseHeaderTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \SprykerEco\Zed\Computop\Business\ComputopBusinessFactory getFactory()
 */
class ComputopFacade extends AbstractFacade implements ComputopFacadeInterface
{
    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param \Generated\Shared\Transfer\CheckoutResponseTransfer $checkoutResponseTransfer
     *
     * @return void
     */
    public function saveOrderPayment(QuoteTransfer $quoteTransfer, CheckoutResponseTransfer $checkoutResponseTransfer)
    {
        $orderSaver = $this->getFactory()->createOrderSaver();

        $orderSaver->saveOrderPayment($quoteTransfer, $checkoutResponseTransfer);
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     * @param \Generated\Shared\Transfer\ComputopHeaderPaymentTransfer $computopHeaderPayment
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function authorizationPaymentRequest(OrderTransfer $orderTransfer, ComputopHeaderPaymentTransfer $computopHeaderPayment)
    {
        $computopResponseTransfer = $this
            ->getFactory()
            ->createAuthorizationPaymentRequest($orderTransfer, $computopHeaderPayment)
            ->request($orderTransfer);

        $this
            ->getFactory()
            ->createAuthorizeResponseHandler()
            ->handle($computopResponseTransfer, $orderTransfer);

        return $computopResponseTransfer;
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     * @param \Generated\Shared\Transfer\ComputopHeaderPaymentTransfer $computopHeaderPayment
     *
     * @return \Generated\Shared\Transfer\ComputopInquireResponseTransfer
     */
    public function inquirePaymentRequest(OrderTransfer $orderTransfer, ComputopHeaderPaymentTransfer $computopHeaderPayment)
    {
        $computopResponseTransfer = $this
            ->getFactory()
            ->createInquirePaymentRequest($orderTransfer, $computopHeaderPayment)
            ->request($orderTransfer);

        $this
            ->getFactory()
            ->createInquireResponseHandler()
            ->handle($computopResponseTransfer, $orderTransfer);

        return $computopResponseTransfer;
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     * @param \Generated\Shared\Transfer\ComputopHeaderPaymentTransfer $computopHeaderPayment
     *
     * @return \Generated\Shared\Transfer\ComputopReverseResponseTransfer
     */
    public function reversePaymentRequest(OrderTransfer $orderTransfer, ComputopHeaderPaymentTransfer $computopHeaderPayment)
    {
        $computopResponseTransfer = $this
            ->getFactory()
            ->createReversePaymentRequest($orderTransfer, $computopHeaderPayment)
            ->request($orderTransfer);

        $this
            ->getFactory()
            ->createReverseResponseHandler()
            ->handle($computopResponseTransfer, $orderTransfer);

        return $computopResponseTransfer;
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param array $orderItems
     *
     * @return void
     */
    public function cancelPaymentItems(array $orderItems)
    {
        $this
            ->getFactory()
            ->createCancelItemManager()
            ->changeComputopItemsStatus($orderItems);
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     * @param \Generated\Shared\Transfer\ComputopHeaderPaymentTransfer $computopHeaderPayment
     *
     * @return \Generated\Shared\Transfer\ComputopCaptureResponseTransfer
     */
    public function capturePaymentRequest(OrderTransfer $orderTransfer, ComputopHeaderPaymentTransfer $computopHeaderPayment)
    {
        $computopResponseTransfer = $this
            ->getFactory()
            ->createCapturePaymentRequest($orderTransfer, $computopHeaderPayment)
            ->request($orderTransfer);

        $this
            ->getFactory()
            ->createCaptureResponseHandler()
            ->handle($computopResponseTransfer, $orderTransfer);

        return $computopResponseTransfer;
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     * @param \Generated\Shared\Transfer\ComputopHeaderPaymentTransfer $computopHeaderPayment
     *
     * @return \Generated\Shared\Transfer\ComputopRefundResponseTransfer
     */
    public function refundPaymentRequest(OrderTransfer $orderTransfer, ComputopHeaderPaymentTransfer $computopHeaderPayment)
    {
        $computopResponseTransfer = $this
            ->getFactory()
            ->createRefundPaymentRequest($orderTransfer, $computopHeaderPayment)
            ->request($orderTransfer);

        $this
            ->getFactory()
            ->createRefundResponseHandler()
            ->handle($computopResponseTransfer, $orderTransfer);

        return $computopResponseTransfer;
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ComputopResponseHeaderTransfer $header
     * @param string $method
     *
     * @return \Generated\Shared\Transfer\ComputopResponseHeaderTransfer
     */
    public function logResponseHeader(ComputopResponseHeaderTransfer $header, $method)
    {
        $this->getFactory()->createComputopResponseLogger()->log($header, $method);

        return $header;
    }

    /**
     * TODO: add test
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function saveSofortResponse(QuoteTransfer $quoteTransfer)
    {
        $this->getFactory()->createSofortResponseHandler()->handle(
            $quoteTransfer
        );

        return $quoteTransfer;
    }

    /**
     * TODO: add test
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function saveIdealResponse(QuoteTransfer $quoteTransfer)
    {
        $this->getFactory()->createIdealResponseHandler()->handle(
            $quoteTransfer
        );

        return $quoteTransfer;
    }

    /**
     * TODO: add test
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function savePaydirektResponse(QuoteTransfer $quoteTransfer)
    {
        $this->getFactory()->createPaydirektResponseHandler()->handle(
            $quoteTransfer
        );

        return $quoteTransfer;
    }
}
