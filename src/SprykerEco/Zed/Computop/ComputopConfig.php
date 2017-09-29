<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\Computop;

use Spryker\Zed\Kernel\AbstractBundleConfig;
use SprykerEco\Shared\Computop\ComputopConstants;

class ComputopConfig extends AbstractBundleConfig
{

    const OMS_STATUS_NEW = 'new';
    const OMS_STATUS_AUTHORIZED = 'authorized';
    const OMS_STATUS_CAPTURED = 'captured';
    const OMS_STATUS_CANCELLED = 'cancelled';
    const OMS_STATUS_REFUNDED = 'refunded';

    const AUTHORIZE_METHOD = 'AUTHORIZE';
    const CAPTURE_METHOD = 'CAPTURE';
    const REVERSE_METHOD = 'REVERSE';
    const INQUIRE_METHOD = 'INQUIRE';
    const REFUND_METHOD = 'REFUND';

    //Events
    const COMPUTOP_OMS_EVENT_CAPTURE = 'capture';

    /**
     * Refund with shipment price
     */
    const COMPUTOP_REFUND_SHIPMENT_PRICE_ENABLED = true;

    /**
     * @return string
     */
    public function getMerchantId()
    {
        return $this->get(ComputopConstants::COMPUTOP_MERCHANT_ID);
    }

    /**
     * @return string
     */
    public function getBlowfishPass()
    {
        return $this->get(ComputopConstants::COMPUTOP_BLOWFISH_PASSWORD);
    }

    /**
     * @return string
     */
    public function getAuthorizeAction()
    {
        return $this->get(ComputopConstants::COMPUTOP_AUTHORIZE_ACTION);
    }

    /**
     * @return string
     */
    public function getCaptureAction()
    {
        return $this->get(ComputopConstants::COMPUTOP_CAPTURE_ACTION);
    }

    /**
     * @return string
     */
    public function getRefundAction()
    {
        return $this->get(ComputopConstants::COMPUTOP_REFUND_ACTION);
    }

    /**
     * @return string
     */
    public function getInquireAction()
    {
        return $this->get(ComputopConstants::COMPUTOP_INQUIRE_ACTION);
    }

    /**
     * @return string
     */
    public function getReverseAction()
    {
        return $this->get(ComputopConstants::COMPUTOP_REVERSE_ACTION);
    }

    /**
     * @return bool
     */
    public function isRefundShipmentPriceEnabled()
    {
        return self::COMPUTOP_REFUND_SHIPMENT_PRICE_ENABLED;
    }

    /**
     * @param string $method
     *
     * @return bool
     */
    public function isNeededRedirectAfterPlaceOrder($method)
    {
        return in_array($method, $this->get(ComputopConstants::COMPUTOP_PAYMENT_METHODS_WITHOUT_ORDER_CALL));
    }

    /**
     * @return string
     */
    public function getOmsStatusNew()
    {
        return self::OMS_STATUS_NEW;
    }

    /**
     * @return string
     */
    public function getOmsStatusAuthorized()
    {
        return self::OMS_STATUS_AUTHORIZED;
    }

    /**
     * @return string
     */
    public function getOmsStatusCaptured()
    {
        return self::OMS_STATUS_CAPTURED;
    }

    /**
     * @return string
     */
    public function getOmsStatusCancelled()
    {
        return self::OMS_STATUS_CANCELLED;
    }

    /**
     * @return string
     */
    public function getOmsStatusRefunded()
    {
        return self::OMS_STATUS_REFUNDED;
    }

    /**
     * @return string
     */
    public function getAuthorizeMethodName()
    {
        return self::AUTHORIZE_METHOD;
    }

    /**
     * @return string
     */
    public function getCaptureMethodName()
    {
        return self::CAPTURE_METHOD;
    }

    /**
     * @return string
     */
    public function getRefundMethodName()
    {
        return self::REFUND_METHOD;
    }

    /**
     * @return string
     */
    public function getReverseMethodName()
    {
        return self::REVERSE_METHOD;
    }

    /**
     * @return string
     */
    public function getInquireMethodName()
    {
        return self::INQUIRE_METHOD;
    }

    /**
     * @return string
     */
    public function getOmsCaptureEventName()
    {
        return self::COMPUTOP_OMS_EVENT_CAPTURE;
    }

}
