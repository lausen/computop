<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Yves\Computop\Form\DataProvider;

use Generated\Shared\Transfer\ComputopCreditCardPaymentTransfer;
use Generated\Shared\Transfer\PaymentTransfer;
use Silex\Application;
use Spryker\Shared\Application\ApplicationConstants;
use Spryker\Shared\Config\Config;
use Spryker\Shared\Kernel\Store;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Yves\StepEngine\Dependency\Form\StepEngineFormDataProviderInterface;
use SprykerEco\Shared\Computop\ComputopConstants;
use SprykerEco\Yves\Computop\Dependency\Client\ComputopToComputopServiceInterface;
use SprykerEco\Yves\Computop\Plugin\Provider\ComputopControllerProvider;

class CreditCardFormDataProvider implements StepEngineFormDataProviderInterface
{

    /**
     * @var \SprykerEco\Yves\Computop\Dependency\Client\ComputopToComputopServiceInterface
     */
    protected $computopService;

    /**
     * @var \Silex\Application
     */
    protected $application;

    /**
     * @param \SprykerEco\Yves\Computop\Dependency\Client\ComputopToComputopServiceInterface $computopService
     * @param \Silex\Application $application
     */
    public function __construct(ComputopToComputopServiceInterface $computopService, Application $application)
    {
        $this->computopService = $computopService;
        $this->application = $application;
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer|\Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Spryker\Shared\Kernel\Transfer\AbstractTransfer
     */
    public function getData(AbstractTransfer $quoteTransfer)
    {
        if ($quoteTransfer->getPayment()->getComputopCreditCard() === null) {
            $paymentTransfer = new PaymentTransfer();
            $computop = $this->createComputopCreditCardPaymentTransfer($quoteTransfer);
            $paymentTransfer->setComputopCreditCard($computop);
            $quoteTransfer->setPayment($paymentTransfer);
        }

        return $quoteTransfer;
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer|\Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return array
     */
    public function getOptions(AbstractTransfer $quoteTransfer)
    {
        return [];
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer|\Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\ComputopCreditCardPaymentTransfer
     */
    protected function createComputopCreditCardPaymentTransfer(AbstractTransfer $quoteTransfer)
    {
        $computopCreditCardPaymentTransfer = new ComputopCreditCardPaymentTransfer();
        $computopCreditCardPaymentTransfer->setMerchantId(Config::get(ComputopConstants::COMPUTOP_MERCHANT_ID_KEY));
        $computopCreditCardPaymentTransfer->setAmount($quoteTransfer->getTotals()->getGrandTotal());
        $computopCreditCardPaymentTransfer->setCurrency(Store::getInstance()->getCurrencyIsoCode());
        $computopCreditCardPaymentTransfer->setCapture(ComputopConstants::CAPTURE_MANUAL_TYPE);

        $computopCreditCardPaymentTransfer->setMac(
            $this->computopService->computopMacEncode($computopCreditCardPaymentTransfer)
        );

        $computopCreditCardPaymentTransfer->setUrlSuccess(
            $this->getAbsoluteUrl($this->application->path(ComputopControllerProvider::SUCCESS_PATH_NAME))
        );
        $computopCreditCardPaymentTransfer->setUrlFailure(
            $this->getAbsoluteUrl($this->application->path(ComputopControllerProvider::FAILURE_PATH_NAME))
        );

        return $computopCreditCardPaymentTransfer;
    }

    /**
     * @param string $path
     *
     * @return string
     */
    protected function getAbsoluteUrl($path)
    {
        return Config::get(ApplicationConstants::BASE_URL_YVES) . $path;
    }

}
