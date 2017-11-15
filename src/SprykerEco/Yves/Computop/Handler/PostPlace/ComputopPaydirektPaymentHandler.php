<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Yves\Computop\Handler\PostPlace;

use Generated\Shared\Transfer\ComputopPaydirektPaymentTransfer;
use Generated\Shared\Transfer\PaymentTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use SprykerEco\Yves\Computop\Handler\AbstractPrePostPaymentHandler;

class ComputopPaydirektPaymentHandler extends AbstractPrePostPaymentHandler
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param array $responseArray
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function handle(QuoteTransfer $quoteTransfer, array $responseArray)
    {
        /** @var \Generated\Shared\Transfer\ComputopPaydirektInitResponseTransfer $responseTransfer */
        $responseTransfer = $this->converter->getResponseTransfer($responseArray);
        $quoteTransfer = $this->addPaymentToQuote($quoteTransfer, $responseTransfer);

        $this->computopClient->logResponse($responseTransfer->getHeader());
        $this->computopClient->savePaydirektInitResponse($quoteTransfer);

        return $quoteTransfer;
    }
    
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $responseTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    protected function addPaymentToQuote(QuoteTransfer $quoteTransfer, AbstractTransfer $responseTransfer)
    {
        if ($quoteTransfer->getPayment() === null) {
            $paymentTransfer = new PaymentTransfer();
            $quoteTransfer->setPayment($paymentTransfer);
        }

        if ($quoteTransfer->getPayment()->getComputopPaydirekt() === null) {
            $computopTransfer = new ComputopPaydirektPaymentTransfer();
            $quoteTransfer->getPayment()->setComputopPaydirekt($computopTransfer);
        }

        $quoteTransfer->getPayment()->getComputopPaydirekt()->setPaydirektInitResponse(
            $responseTransfer
        );

        return $quoteTransfer;
    }
}
