<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Yves\Computop;

use Spryker\Yves\Kernel\AbstractFactory;
use SprykerEco\Yves\Computop\Converter\InitCreditCardConverter;
use SprykerEco\Yves\Computop\Converter\InitDirectDebitConverter;
use SprykerEco\Yves\Computop\Converter\InitIdealConverter;
use SprykerEco\Yves\Computop\Converter\InitPaydirektConverter;
use SprykerEco\Yves\Computop\Converter\InitPayPalConverter;
use SprykerEco\Yves\Computop\Converter\InitSofortConverter;
use SprykerEco\Yves\Computop\Form\CreditCardSubForm;
use SprykerEco\Yves\Computop\Form\DataProvider\CreditCardFormDataProvider;
use SprykerEco\Yves\Computop\Form\DataProvider\DirectDebitFormDataProvider;
use SprykerEco\Yves\Computop\Form\DataProvider\EasyCreditFormDataProvider;
use SprykerEco\Yves\Computop\Form\DataProvider\IdealFormDataProvider;
use SprykerEco\Yves\Computop\Form\DataProvider\PaydirektFormDataProvider;
use SprykerEco\Yves\Computop\Form\DataProvider\PayPalFormDataProvider;
use SprykerEco\Yves\Computop\Form\DataProvider\SofortFormDataProvider;
use SprykerEco\Yves\Computop\Form\DirectDebitSubForm;
use SprykerEco\Yves\Computop\Form\EasyCreditSubForm;
use SprykerEco\Yves\Computop\Form\IdealSubForm;
use SprykerEco\Yves\Computop\Form\PaydirektSubForm;
use SprykerEco\Yves\Computop\Form\PayPalSubForm;
use SprykerEco\Yves\Computop\Form\SofortSubForm;
use SprykerEco\Yves\Computop\Handler\ComputopPaymentHandler;
use SprykerEco\Yves\Computop\Handler\PostPlace\ComputopIdealPaymentHandler;
use SprykerEco\Yves\Computop\Handler\PostPlace\ComputopPaydirektPaymentHandler;
use SprykerEco\Yves\Computop\Handler\PostPlace\ComputopSofortPaymentHandler;
use SprykerEco\Yves\Computop\Handler\PrePlace\ComputopCreditCardPaymentHandler;
use SprykerEco\Yves\Computop\Handler\PrePlace\ComputopDirectDebitPaymentHandler;
use SprykerEco\Yves\Computop\Handler\PrePlace\ComputopPayPalPaymentHandler;
use SprykerEco\Yves\Computop\Mapper\Init\PostPlace\IdealMapper;
use SprykerEco\Yves\Computop\Mapper\Init\PostPlace\PaydirektMapper;
use SprykerEco\Yves\Computop\Mapper\Init\PostPlace\SofortMapper;
use SprykerEco\Yves\Computop\Mapper\Init\PrePlace\CreditCardMapper;
use SprykerEco\Yves\Computop\Mapper\Init\PrePlace\DirectDebitMapper;
use SprykerEco\Yves\Computop\Mapper\Init\PrePlace\EasyCreditMapper;
use SprykerEco\Yves\Computop\Mapper\Init\PrePlace\PayPalMapper;

/**
 * @method \SprykerEco\Yves\Computop\ComputopConfig getConfig()
 */
class ComputopFactory extends AbstractFactory
{
    /**
     * @return \SprykerEco\Yves\Computop\ComputopConfigInterface
     */
    public function getComputopConfig()
    {
        return $this->getConfig();
    }

    /**
     * @return \Spryker\Yves\StepEngine\Dependency\Form\SubFormInterface
     */
    public function createCreditCardForm()
    {
        return new CreditCardSubForm();
    }

    /**
     * @return \Spryker\Yves\StepEngine\Dependency\Form\SubFormInterface
     */
    public function createPayPalForm()
    {
        return new PayPalSubForm();
    }

    /**
     * @return \Spryker\Yves\StepEngine\Dependency\Form\SubFormInterface
     */
    public function createSofortForm()
    {
        return new SofortSubForm();
    }

    /**
     * @return \Spryker\Yves\StepEngine\Dependency\Form\SubFormInterface
     */
    public function createDirectDebitForm()
    {
        return new DirectDebitSubForm();
    }

    /**
     * @return \Spryker\Yves\StepEngine\Dependency\Form\SubFormInterface
     */
    public function createPaydirektForm()
    {
        return new PaydirektSubForm();
    }

    /**
     * @return \Spryker\Yves\StepEngine\Dependency\Form\SubFormInterface
     */
    public function createIdealForm()
    {
        return new IdealSubForm();
    }

    /**
     * @return \Spryker\Yves\StepEngine\Dependency\Form\SubFormInterface
     */
    public function createEasyCreditForm()
    {
        return new EasyCreditSubForm();
    }

    /**
     * @return \Spryker\Yves\StepEngine\Dependency\Form\StepEngineFormDataProviderInterface
     */
    public function createCreditCardFormDataProvider()
    {
        return new CreditCardFormDataProvider($this->getQuoteClient(), $this->createOrderCreditCardMapper());
    }

    /**
     * @return \Spryker\Yves\StepEngine\Dependency\Form\StepEngineFormDataProviderInterface
     */
    public function createPayPalFormDataProvider()
    {
        return new PayPalFormDataProvider($this->getQuoteClient(), $this->createOrderPayPalMapper());
    }

    /**
     * @return \Spryker\Yves\StepEngine\Dependency\Form\StepEngineFormDataProviderInterface
     */
    public function createSofortFormDataProvider()
    {
        return new SofortFormDataProvider($this->getQuoteClient(), $this->createOrderSofortMapper());
    }

    /**
     * @return \Spryker\Yves\StepEngine\Dependency\Form\StepEngineFormDataProviderInterface
     */
    public function createDirectDebitFormDataProvider()
    {
        return new DirectDebitFormDataProvider($this->getQuoteClient(), $this->createOrderDirectDebitMapper());
    }

    /**
     * @return \Spryker\Yves\StepEngine\Dependency\Form\StepEngineFormDataProviderInterface
     */
    public function createPaydirektFormDataProvider()
    {
        return new PaydirektFormDataProvider($this->getQuoteClient(), $this->createOrderPaydirektMapper());
    }

    /**
     * @return \Spryker\Yves\StepEngine\Dependency\Form\StepEngineFormDataProviderInterface
     */
    public function createIdealFormDataProvider()
    {
        return new IdealFormDataProvider($this->getQuoteClient(), $this->createOrderIdealMapper());
    }

    /**
     * @return \Spryker\Yves\StepEngine\Dependency\Form\StepEngineFormDataProviderInterface
     */
    public function createEasyCreditFormDataProvider()
    {
        return new EasyCreditFormDataProvider($this->getQuoteClient(), $this->createOrderEasyCreditMapper());
    }

    /**
     * @return \SprykerEco\Client\Computop\ComputopClientInterface
     */
    public function getComputopClient()
    {
        return $this->getProvidedDependency(ComputopDependencyProvider::CLIENT_COMPUTOP);
    }

    /**
     * @return \SprykerEco\Service\Computop\ComputopServiceInterface
     */
    public function getComputopService()
    {
        return $this->getProvidedDependency(ComputopDependencyProvider::SERVICE_COMPUTOP);
    }

    /**
     * @return \Symfony\Component\HttpKernel\HttpKernelInterface
     */
    public function getApplication()
    {
        return $this->getProvidedDependency(ComputopDependencyProvider::PLUGIN_APPLICATION);
    }

    /**
     * @return \SprykerEco\Yves\Computop\Dependency\Client\ComputopToQuoteClientInterface
     */
    public function getQuoteClient()
    {
        return $this->getProvidedDependency(ComputopDependencyProvider::CLIENT_QUOTE);
    }

    /**
     * @return \SprykerEco\Yves\Computop\Handler\ComputopPrePostPaymentHandlerInterface
     */
    public function createCreditCardPaymentHandler()
    {
        return new ComputopCreditCardPaymentHandler($this->createInitCreditCardConverter(), $this->getComputopClient());
    }

    /**
     * @return \SprykerEco\Yves\Computop\Handler\ComputopPrePostPaymentHandlerInterface
     */
    public function createPayPalPaymentHandler()
    {
        return new ComputopPayPalPaymentHandler($this->createInitPayPalConverter(), $this->getComputopClient());
    }

    /**
     * @return \SprykerEco\Yves\Computop\Handler\ComputopPrePostPaymentHandlerInterface
     */
    public function createDirectDebitPaymentHandler()
    {
        return new ComputopDirectDebitPaymentHandler($this->createInitDirectDebitConverter(), $this->getComputopClient());
    }

    /**
     * @return \SprykerEco\Yves\Computop\Handler\ComputopPrePostPaymentHandlerInterface
     */
    public function createPaydirektPaymentHandler()
    {
        return new ComputopPaydirektPaymentHandler($this->createInitPaydirektConverter(), $this->getComputopClient());
    }

    /**
     * @return \SprykerEco\Yves\Computop\Handler\ComputopPrePostPaymentHandlerInterface
     */
    public function createSofortPaymentHandler()
    {
        return new ComputopSofortPaymentHandler($this->createInitSofortConverter(), $this->getComputopClient());
    }

    /**
     * @return \SprykerEco\Yves\Computop\Handler\ComputopPrePostPaymentHandlerInterface
     */
    public function createIdealPaymentHandler()
    {
        return new ComputopIdealPaymentHandler($this->createInitIdealConverter(), $this->getComputopClient());
    }

    /**
     * @return \SprykerEco\Yves\Computop\Converter\ConverterInterface
     */
    public function createInitCreditCardConverter()
    {
        return new InitCreditCardConverter($this->getComputopService(), $this->getConfig());
    }

    /**
     * @return \SprykerEco\Yves\Computop\Converter\ConverterInterface
     */
    public function createInitPayPalConverter()
    {
        return new InitPayPalConverter($this->getComputopService(), $this->getConfig());
    }

    /**
     * @return \SprykerEco\Yves\Computop\Converter\ConverterInterface
     */
    public function createInitDirectDebitConverter()
    {
        return new InitDirectDebitConverter($this->getComputopService(), $this->getConfig());
    }

    /**
     * @return \SprykerEco\Yves\Computop\Converter\ConverterInterface
     */
    public function createInitPaydirektConverter()
    {
        return new InitPaydirektConverter($this->getComputopService(), $this->getConfig());
    }

    /**
     * @return \SprykerEco\Yves\Computop\Converter\ConverterInterface
     */
    public function createInitSofortConverter()
    {
        return new InitSofortConverter($this->getComputopService(), $this->getConfig());
    }

    /**
     * @return \SprykerEco\Yves\Computop\Converter\ConverterInterface
     */
    public function createInitIdealConverter()
    {
        return new InitIdealConverter($this->getComputopService(), $this->getConfig());
    }

    /**
     * @return \SprykerEco\Yves\Computop\Handler\ComputopPaymentHandlerInterface
     */
    public function createComputopPaymentHandler()
    {
        return new ComputopPaymentHandler($this->getConfig());
    }

    /**
     * @return \SprykerEco\Yves\Computop\Dependency\ComputopToStoreInterface
     */
    protected function getStore()
    {
        return $this->getProvidedDependency(ComputopDependencyProvider::STORE);
    }

    /**
     * @return \SprykerEco\Yves\Computop\Mapper\Init\MapperInterface
     */
    protected function createOrderCreditCardMapper()
    {
        return new CreditCardMapper($this->getComputopService(), $this->getApplication(), $this->getStore(), $this->getConfig());
    }

    /**
     * @return \SprykerEco\Yves\Computop\Mapper\Init\MapperInterface
     */
    protected function createOrderPayPalMapper()
    {
        return new PayPalMapper($this->getComputopService(), $this->getApplication(), $this->getStore(), $this->getConfig());
    }

    /**
     * @return \SprykerEco\Yves\Computop\Mapper\Init\MapperInterface
     */
    protected function createOrderDirectDebitMapper()
    {
        return new DirectDebitMapper($this->getComputopService(), $this->getApplication(), $this->getStore(), $this->getConfig());
    }

    /**
     * @return \SprykerEco\Yves\Computop\Mapper\Init\MapperInterface
     */
    protected function createOrderSofortMapper()
    {
        return new SofortMapper($this->getComputopService(), $this->getApplication(), $this->getStore(), $this->getConfig());
    }

    /**
     * @return \SprykerEco\Yves\Computop\Mapper\Init\MapperInterface
     */
    protected function createOrderPaydirektMapper()
    {
        return new PaydirektMapper($this->getComputopService(), $this->getApplication(), $this->getStore(), $this->getConfig());
    }

    /**
     * @return \SprykerEco\Yves\Computop\Mapper\Init\MapperInterface
     */
    protected function createOrderIdealMapper()
    {
        return new IdealMapper($this->getComputopService(), $this->getApplication(), $this->getStore(), $this->getConfig());
    }
    
    /**
     * @return \SprykerEco\Yves\Computop\Mapper\Init\MapperInterface
     */
    protected function createOrderEasyCreditMapper()
    {
        return new EasyCreditMapper($this->getComputopService(), $this->getApplication(), $this->getStore(), $this->getConfig());
    }
}
