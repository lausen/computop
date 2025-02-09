<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Yves\Computop\Form;

use Generated\Shared\Transfer\ComputopDirectDebitPaymentTransfer;
use Generated\Shared\Transfer\PaymentTransfer;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DirectDebitSubForm extends AbstractSubForm
{
    /**
     * @var string
     */
    public const PAYMENT_METHOD = 'direct-debit';

    /**
     * @return string
     */
    public function getName(): string
    {
        return PaymentTransfer::COMPUTOP_DIRECT_DEBIT;
    }

    /**
     * @return string
     */
    public function getPropertyPath(): string
    {
        return PaymentTransfer::COMPUTOP_DIRECT_DEBIT;
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ComputopDirectDebitPaymentTransfer::class,
        ])->setRequired(static::OPTIONS_FIELD_NAME);
    }

    /**
     * @return string
     */
    protected function getPaymentMethod(): string
    {
        return static::PAYMENT_METHOD;
    }
}
