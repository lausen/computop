<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Yves\Computop\Converter;

use Generated\Shared\Transfer\ComputopCreditCardOrderResponseTransfer;
use Generated\Shared\Transfer\ComputopResponseHeaderTransfer;
use SprykerEco\Shared\Computop\Config\ComputopApiConfig;

class OrderCreditCardConverter extends AbstractOrderConverter
{
    /**
     * @param array $decryptedArray
     * @param \Generated\Shared\Transfer\ComputopResponseHeaderTransfer $header
     *
     * @return \Generated\Shared\Transfer\ComputopCreditCardOrderResponseTransfer
     */
    public function createResponseTransfer(array $decryptedArray, ComputopResponseHeaderTransfer $header)
    {
        $responseTransfer = new ComputopCreditCardOrderResponseTransfer();
        $responseTransfer->fromArray($decryptedArray, true);
        $responseTransfer->setHeader($header);
        //optional fields
        $responseTransfer->setPcnr($this->computopService->getResponseValue($decryptedArray, ComputopApiConfig::PCN_R));
        $responseTransfer->setCCBrand($this->computopService->getResponseValue($decryptedArray, ComputopApiConfig::CC_BRAND));
        $responseTransfer->setCCExpiry($this->computopService->getResponseValue($decryptedArray, ComputopApiConfig::CC_EXPIRY));
        $responseTransfer->setMaskedPan($this->computopService->getResponseValue($decryptedArray, ComputopApiConfig::MASKED_PAN));
        $responseTransfer->setCavv($this->computopService->getResponseValue($decryptedArray, ComputopApiConfig::CAVV));
        $responseTransfer->setEci($this->computopService->getResponseValue($decryptedArray, ComputopApiConfig::ECI));
        $responseTransfer->setType($this->computopService->getResponseValue($decryptedArray, ComputopApiConfig::TYPE));
        $responseTransfer->setPlain($this->computopService->getResponseValue($decryptedArray, ComputopApiConfig::PLAIN));
        $responseTransfer->setCustom($this->computopService->getResponseValue($decryptedArray, ComputopApiConfig::CUSTOM));

        return $responseTransfer;
    }
}
