<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\Computop\Zed;

use Generated\Shared\Transfer\ComputopResponseHeaderTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

interface ComputopStubInterface
{
    /**
     * @param \Generated\Shared\Transfer\ComputopResponseHeaderTransfer $responseTransfer
     *
     * @return void
     */
    public function logResponse(ComputopResponseHeaderTransfer $responseTransfer);

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $responseTransfer
     *
     * @return void
     */
    public function saveSofortInitResponse(QuoteTransfer $responseTransfer);

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $responseTransfer
     *
     * @return void
     */
    public function saveIdealInitResponse(QuoteTransfer $responseTransfer);

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $responseTransfer
     *
     * @return void
     */
    public function savePaydirektInitResponse(QuoteTransfer $responseTransfer);

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $responseTransfer
     *
     * @return void
     */
    public function saveCreditCardInitResponse(QuoteTransfer $responseTransfer);

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $responseTransfer
     *
     * @return void
     */
    public function savePayPalInitResponse(QuoteTransfer $responseTransfer);

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $responseTransfer
     *
     * @return void
     */
    public function saveDirectDebitInitResponse(QuoteTransfer $responseTransfer);

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $responseTransfer
     *
     * @return void
     */
    public function saveEasyCreditInitResponse(QuoteTransfer $responseTransfer);

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function easyCreditStatusApiCall(QuoteTransfer $quoteTransfer);
}
