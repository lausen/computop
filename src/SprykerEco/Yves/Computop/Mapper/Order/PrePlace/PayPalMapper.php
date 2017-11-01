<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Yves\Computop\Mapper\Order\PrePlace;

use Generated\Shared\Transfer\ComputopPayPalPaymentTransfer;
use Spryker\Shared\Config\Config;
use Spryker\Shared\Kernel\Transfer\TransferInterface;
use SprykerEco\Shared\Computop\ComputopConstants;
use SprykerEco\Shared\Computop\Config\ComputopFieldName;
use SprykerEco\Yves\Computop\ComputopConfig;
use SprykerEco\Yves\Computop\Plugin\Provider\ComputopControllerProvider;

class PayPalMapper extends AbstractPrePlaceMapper
{
    const NO_SHIPPING = 1;

    /**
     * @param \Spryker\Shared\Kernel\Transfer\TransferInterface|\Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\ComputopPayPalPaymentTransfer
     */
    protected function createTransferWithUnencryptedValues(TransferInterface $quoteTransfer)
    {
        $computopPaymentTransfer = new ComputopPayPalPaymentTransfer();

        $computopPaymentTransfer->setTransId($this->getTransId($quoteTransfer));
        $computopPaymentTransfer->setTxType(ComputopConfig::TX_TYPE_ORDER);
        $computopPaymentTransfer->setUrlSuccess(
            $this->getAbsoluteUrl($this->application->path(ComputopControllerProvider::PAY_PAL_SUCCESS_PATH_NAME))
        );
        $computopPaymentTransfer->setOrderDesc(
            $this->computopService->getDescriptionValue($quoteTransfer->getItems()->getArrayCopy())
        );

        return $computopPaymentTransfer;
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\TransferInterface $cardPaymentTransfer
     *
     * @return array
     */
    protected function getDataSubArray(TransferInterface $cardPaymentTransfer)
    {
        /** @var \Generated\Shared\Transfer\ComputopPayPalPaymentTransfer $cardPaymentTransfer */
        $dataSubArray[ComputopFieldName::TRANS_ID] = $cardPaymentTransfer->getTransId();
        $dataSubArray[ComputopFieldName::AMOUNT] = $cardPaymentTransfer->getAmount();
        $dataSubArray[ComputopFieldName::CURRENCY] = $cardPaymentTransfer->getCurrency();
        $dataSubArray[ComputopFieldName::URL_SUCCESS] = $cardPaymentTransfer->getUrlSuccess();
        $dataSubArray[ComputopFieldName::URL_FAILURE] = $cardPaymentTransfer->getUrlFailure();
        $dataSubArray[ComputopFieldName::CAPTURE] = $cardPaymentTransfer->getCapture();
        $dataSubArray[ComputopFieldName::RESPONSE] = $cardPaymentTransfer->getResponse();
        $dataSubArray[ComputopFieldName::MAC] = $cardPaymentTransfer->getMac();
        $dataSubArray[ComputopFieldName::TX_TYPE] = $cardPaymentTransfer->getTxType();
        $dataSubArray[ComputopFieldName::ORDER_DESC] = $cardPaymentTransfer->getOrderDesc();
        $dataSubArray[ComputopFieldName::ETI_ID] = ComputopConfig::ETI_ID;
        $dataSubArray[ComputopFieldName::NO_SHIPPING] = self::NO_SHIPPING;

        return $dataSubArray;
    }

    /**
     * @return string
     */
    protected function getActionUrl()
    {
        return Config::get(ComputopConstants::PAYPAL_ORDER_ACTION);
    }
}
