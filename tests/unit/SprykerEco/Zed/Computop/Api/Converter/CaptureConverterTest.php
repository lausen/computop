<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Unit\SprykerEco\Zed\Computop\Api\Converter;

use Computop\Helper\Unit\Zed\Api\Converter\ConverterTestConstants;
use Generated\Shared\Transfer\ComputopResponseHeaderTransfer;
use SprykerEco\Shared\Computop\Config\ComputopFieldName;
use SprykerEco\Zed\Computop\Business\Api\Converter\CaptureConverter;

/**
 * @group Unit
 * @group SprykerEco
 * @group Zed
 * @group Computop
 * @group Api
 * @group Converter
 * @group CaptureConverterTest
 */
class CaptureConverterTest extends AbstractConverterTest
{
    /**
     * @return void
     */
    public function testToTransactionResponseTransfer()
    {
        $response = $this->helper->prepareResponse();
        $service = $this->createConverter();

        /** @var \Generated\Shared\Transfer\ComputopCaptureResponseTransfer $responseTransfer */
        $responseTransfer = $service->toTransactionResponseTransfer($response);

        $this->assertInstanceOf(ComputopResponseHeaderTransfer::class, $responseTransfer->getHeader());
        $this->assertEquals(ConverterTestConstants::A_ID_VALUE, $responseTransfer->getAId());
        $this->assertEquals(ConverterTestConstants::TRANSACTION_ID_VALUE, $responseTransfer->getTransactionId());
        $this->assertEquals(ConverterTestConstants::AMOUNT_VALUE_NOT_ZERO, $responseTransfer->getAmount());
        $this->assertEquals(ConverterTestConstants::CODE_EXT_VALUE, $responseTransfer->getCodeExt());
        $this->assertEquals(ConverterTestConstants::ERROR_TEXT_VALUE, $responseTransfer->getErrorText());
        $this->assertEquals(ConverterTestConstants::REF_NR_VALUE, $responseTransfer->getRefNr());
    }

    /**
     * @return \SprykerEco\Zed\Computop\Business\Api\Converter\CaptureConverter
     */
    protected function createConverter()
    {
        $computopServiceMock = $this->helper->createComputopServiceMock($this->getDecryptedArray());
        $configMock = $this->helper->createComputopConfigMock();

        $converter = new CaptureConverter($computopServiceMock, $configMock);

        return $converter;
    }

    /**
     * @return array
     */
    protected function getDecryptedArray()
    {
        $decryptedArray = $this->helper->getMainDecryptedArray();

        $decryptedArray[ComputopFieldName::A_ID] = ConverterTestConstants::A_ID_VALUE;
        $decryptedArray[ComputopFieldName::TRANSACTION_ID] = ConverterTestConstants::TRANSACTION_ID_VALUE;
        $decryptedArray[ComputopFieldName::AMOUNT] = ConverterTestConstants::AMOUNT_VALUE_NOT_ZERO;
        $decryptedArray[ComputopFieldName::CODE_EXT] = ConverterTestConstants::CODE_EXT_VALUE;
        $decryptedArray[ComputopFieldName::ERROR_TEXT] = ConverterTestConstants::ERROR_TEXT_VALUE;
        $decryptedArray[ComputopFieldName::REF_NR] = ConverterTestConstants::REF_NR_VALUE;

        return $decryptedArray;
    }
}
