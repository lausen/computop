<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\Computop\Business\Api\Adapter;

use Spryker\Shared\Config\Config;
use SprykerEco\Shared\Computop\ComputopConstants;

class AuthorizeApiAdapter extends AbstractApiAdapter
{

    /**
     * @return string
     */
    protected function getUrl()
    {
        return Config::get(ComputopConstants::COMPUTOP_CREDIT_CARD_AUTHORIZE_ACTION_KEY);
    }

}
