<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Shared\Computop;

interface ComputopConstants
{
    const HMAC_PASSWORD = 'COMPUTOP:HMAC_PASSWORD';
    const PAYDIREKT_SHOP_KEY = 'COMPUTOP:PAYDIREKT_SHOP_KEY';

    const PAY_NOW_INIT_ACTION = 'COMPUTOP:PAY_NOW_INIT_ACTION';
    const CREDIT_CARD_INIT_ACTION = 'COMPUTOP:CREDIT_CARD_INIT_ACTION';
    const PAYPAL_INIT_ACTION = 'COMPUTOP:PAYPAL_INIT_ACTION';
    const DIRECT_DEBIT_INIT_ACTION = 'COMPUTOP:DIRECT_DEBIT_INIT_ACTION';
    const SOFORT_INIT_ACTION = 'COMPUTOP:SOFORT_INIT_ACTION';
    const PAYDIREKT_INIT_ACTION = 'COMPUTOP:PAYDIREKT_INIT_ACTION';
    const IDEAL_INIT_ACTION = 'COMPUTOP:IDEAL_INIT_ACTION';
    const EASY_CREDIT_INIT_ACTION = 'COMPUTOP:EASY_CREDIT_INIT_ACTION';

    const EASY_CREDIT_STATUS_ACTION = 'COMPUTOP:EASY_CREDIT_STATUS_ACTION';
    const EASY_CREDIT_AUTHORIZE_ACTION = 'COMPUTOP:EASY_CREDIT_AUTHORIZE_ACTION';

    const CRIF_ACTION = 'COMPUTOP:CRIF_ACTION';

    const AUTHORIZE_ACTION = 'COMPUTOP:AUTHORIZE_ACTION';
    const CAPTURE_ACTION = 'COMPUTOP:CAPTURE_ACTION';
    const REVERSE_ACTION = 'COMPUTOP:REVERSE_ACTION';
    const INQUIRE_ACTION = 'COMPUTOP:INQUIRE_ACTION';
    const REFUND_ACTION = 'COMPUTOP:REFUND_ACTION';
    
    const RESPONSE_MAC_REQUIRED = 'COMPUTOP:RESPONSE_MAC_REQUIRED';
    const PAYMENT_METHODS_WITHOUT_ORDER_CALL = 'COMPUTOP:PAYMENT_METHODS_WITHOUT_ORDER_CALL';

    const CREDIT_CARD_TEMPLATE_ENABLED = 'COMPUTOP:CREDIT_CARD_TEMPLATE_ENABLED';
}
