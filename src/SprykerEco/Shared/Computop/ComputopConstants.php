<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Shared\Computop;

interface ComputopConstants
{

    const PROVIDER_NAME = 'Computop';
    const PAYMENT_METHOD_CREDIT_CARD = 'ComputopCreditCard';
    const PAYMENT_METHOD_PAY_PAL = 'ComputopPayPal';
    const PAYMENT_METHOD_DIRECT_DEBIT = 'ComputopDirectDebit';

    //Statuses
    const COMPUTOP_OMS_STATUS_NEW = 'new';
    const COMPUTOP_OMS_STATUS_AUTHORIZED = 'authorized';
    const COMPUTOP_OMS_STATUS_CAPTURED = 'captured';
    const COMPUTOP_OMS_STATUS_CANCELLED = 'cancelled';
    const COMPUTOP_OMS_STATUS_REFUNDED = 'refunded';

    //Computop provider constants
    const CAPTURE_AUTO_TYPE = 'AUTO';
    const CAPTURE_MANUAL_TYPE = 'MANUAL';
    const CAPTURE_DELAY_TYPE = 696; //Delay in hours until the capture (whole number; 1 to 696).

    const RESPONSE_TYPE = 'encrypt';
    const TX_TYPE_ORDER = 'Order';

    const ORDER_DESC_SUCCESS = 'Test:0000';
    const ORDER_DESC_ERROR = 'Test:0305';

    const ETI_ID = '0.0.1'; //Parameter is requested by Computop
    const FINISH_AUTH = 'Y'; //Only with ETM: Transmit value <Y> in order to stop the renewal of guaranteed authorizations and rest amounts after partial captures.

    const SUCCESS_STATUS = 'OK';

    //Config data
    const COMPUTOP_MERCHANT_ID = 'COMPUTOP_MERCHANT_ID';
    const COMPUTOP_BLOWFISH_PASSWORD = 'COMPUTOP_BLOWFISH_PASSWORD';
    const COMPUTOP_HMAC_PASSWORD = 'COMPUTOP_HMAC_PASSWORD';

    const COMPUTOP_CREDIT_CARD_ORDER_ACTION = 'COMPUTOP_CREDIT_CARD_ORDER_ACTION';
    const COMPUTOP_AUTHORIZE_ACTION = 'COMPUTOP_AUTHORIZE_ACTION';
    const COMPUTOP_CAPTURE_ACTION = 'COMPUTOP_CAPTURE_ACTION';
    const COMPUTOP_REVERSE_ACTION = 'COMPUTOP_REVERSE_ACTION';
    const COMPUTOP_INQUIRE_ACTION = 'COMPUTOP_INQUIRE_ACTION';
    const COMPUTOP_REFUND_ACTION = 'COMPUTOP_REFUND_ACTION';

    const COMPUTOP_PAY_PAL_ORDER_ACTION = 'COMPUTOP_PAY_PAL_ORDER_ACTION';
    const COMPUTOP_DIRECT_DEBIT_ORDER_ACTION = 'COMPUTOP_DIRECT_DEBIT_ORDER_ACTION';

    const COMPUTOP_RESPONSE_MAC_REQUIRED = 'COMPUTOP_RESPONSE_MAC_REQUIRED';

    const ORDER_METHOD = 'ORDER';
    const AUTHORIZE_METHOD = 'AUTHORIZE';
    const CAPTURE_METHOD = 'CAPTURE';
    const REVERSE_METHOD = 'REVERSE';
    const INQUIRE_METHOD = 'INQUIRE';
    const REFUND_METHOD = 'REFUND';

    //Field names
    const MERCHANT_ID_F_N = 'MerchantID';
    const TRANS_ID_F_N = 'TransID';
    const AMOUNT_F_N = 'Amount';
    const AMOUNT_AUTH_F_N = 'AmountAuth';
    const AMOUNT_CAP_F_N = 'AmountCap';
    const AMOUNT_CRED_F_N = 'AmountCred';
    const CURRENCY_F_N = 'Currency';
    const URL_SUCCESS_F_N = 'URLSuccess';
    const URL_FAILURE_F_N = 'URLFailure';
    const CAPTURE_F_N = 'Capture';
    const RESPONSE_F_N = 'Response';
    const MAC_F_N = 'MAC';
    const TX_TYPE_F_N = 'TxType';
    const ORDER_DESC_F_N = 'OrderDesc';
    const PAY_ID_F_N = 'PayID';
    const MID_F_N = 'mid';
    const STATUS_F_N = 'Status';
    const DESCRIPTION_F_N = 'Description';
    const CODE_F_N = 'Code';
    const XID_F_N = 'XID';
    const TYPE_F_N = 'Type';
    const PCN_R_F_N = 'PCNr';
    const CC_EXPIRY_F_N = 'CCExpiry';
    const CC_BRAND_F_N = 'CCBrand';
    const REF_NR_F_N = 'RefNr';
    const A_ID_F_N = 'AID';
    const CODE_EXT_F_N = 'CodeExt';
    const ERROR_TEXT_F_N = 'ErrorText';
    const TRANSACTION_ID_F_N = 'TransactionID';
    const FINISH_AUTH_F_N = 'FinishAuth';
    const ETI_ID_F_N = 'EtiId';
    const DATA_F_N = 'Data';
    const LENGTH_F_N = 'Len';

    const MANDATE_ID_F_N = 'mandateid';
    const DATE_OF_SIGNATURE_ID_F_N = 'dtofsgntr';
    const I_B_A_N_F_N = 'IBAN';
    const ACCOUNT_OWNER_F_N = 'accOwner';
    const MDT_SEQ_TYPE_F_N = 'mdtseqtype';

}
