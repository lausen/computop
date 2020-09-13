<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Yves\Computop\CheckoutPage\Process\Steps;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Yves\StepEngine\Dependency\Step\StepWithExternalRedirectInterface;
use SprykerEco\Shared\Computop\ComputopConfig;
use SprykerShop\Yves\CheckoutPage\Process\Steps\AbstractBaseStep;
use Symfony\Component\HttpFoundation\Request;

class ComputopEasyCreditInitStep extends AbstractBaseStep implements StepWithExternalRedirectInterface
{
    /**
     * @var string
     */
    protected $redirectUrl = '';

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return bool
     */
    public function requireInput(AbstractTransfer $quoteTransfer): bool
    {
        return false;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function execute(Request $request, AbstractTransfer $quoteTransfer)
    {
        if (
            !$quoteTransfer->getPayment()
            || $quoteTransfer->getPayment()->getPaymentSelection() !== ComputopConfig::PAYMENT_METHOD_EASY_CREDIT
        ) {
            return $quoteTransfer;
        }

        $this->redirectUrl = $quoteTransfer->getPayment()->getComputopEasyCredit()->getUrl();

        return $quoteTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return bool
     */
    public function postCondition(AbstractTransfer $quoteTransfer): bool
    {
        return true;
    }

    /**
     * @return string
     */
    public function getExternalRedirectUrl(): string
    {
        return $this->redirectUrl;
    }
}
