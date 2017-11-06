<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\Computop\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use SprykerEco\Zed\Computop\Business\Api\ComputopBusinessApiFactory;
use SprykerEco\Zed\Computop\Business\Oms\Command\CancelItemManager;
use SprykerEco\Zed\Computop\Business\Order\ComputopBusinessOrderFactory;
use SprykerEco\Zed\Computop\Business\Order\OrderManager;
use SprykerEco\Zed\Computop\Business\Payment\Handler\AuthorizeResponseHandler;
use SprykerEco\Zed\Computop\Business\Payment\Handler\CaptureResponseHandler;
use SprykerEco\Zed\Computop\Business\Payment\Handler\InquireResponseHandler;
use SprykerEco\Zed\Computop\Business\Payment\Handler\Logger\ComputopResponseLogger;
use SprykerEco\Zed\Computop\Business\Payment\Handler\Order\IdealResponseHandler;
use SprykerEco\Zed\Computop\Business\Payment\Handler\Order\PaydirektResponseHandler;
use SprykerEco\Zed\Computop\Business\Payment\Handler\Order\SofortResponseHandler;
use SprykerEco\Zed\Computop\Business\Payment\Handler\RefundResponseHandler;
use SprykerEco\Zed\Computop\Business\Payment\Handler\ReverseResponseHandler;
use SprykerEco\Zed\Computop\ComputopDependencyProvider;

/**
 * @method \SprykerEco\Zed\Computop\ComputopConfig getConfig()
 * @method \SprykerEco\Zed\Computop\Persistence\ComputopQueryContainerInterface getQueryContainer()
 */
class ComputopBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \SprykerEco\Zed\Computop\Business\Api\ComputopBusinessApiFactoryInterface
     */
    public function createApiFactory()
    {
        return new ComputopBusinessApiFactory();
    }

    /**
     * @return \SprykerEco\Zed\Computop\Business\Order\OrderManagerInterface
     */
    public function createOrderSaver()
    {
        $orderSaver = new OrderManager($this->getConfig());

        $orderSaver->registerMapper($this->createOrderFactory()->createOrderCreditCardMapper());
        $orderSaver->registerMapper($this->createOrderFactory()->createOrderPayPalMapper());
        $orderSaver->registerMapper($this->createOrderFactory()->createOrderDirectDebitMapper());
        $orderSaver->registerMapper($this->createOrderFactory()->createOrderSofortMapper());
        $orderSaver->registerMapper($this->createOrderFactory()->createOrderPaydirektMapper());
        $orderSaver->registerMapper($this->createOrderFactory()->createOrderIdealMapper());

        return $orderSaver;
    }

    /**
     * @return \SprykerEco\Zed\Computop\Business\Api\Request\RequestInterface
     */
    public function createAuthorizationPaymentRequest()
    {
        return $this->createApiFactory()->createAuthorizationPaymentRequest();
    }

    /**
     * @return \SprykerEco\Zed\Computop\Business\Api\Request\RequestInterface
     */
    public function createInquirePaymentRequest()
    {
        return $this->createApiFactory()->createInquirePaymentRequest();
    }

    /**
     * @return \SprykerEco\Zed\Computop\Business\Api\Request\RequestInterface
     */
    public function createReversePaymentRequest()
    {
        return $this->createApiFactory()->createReversePaymentRequest();
    }

    /**
     * @return \SprykerEco\Zed\Computop\Business\Api\Request\RequestInterface
     */
    public function createCapturePaymentRequest()
    {
        return $this->createApiFactory()->createCapturePaymentRequest();
    }

    /**
     * @return \SprykerEco\Zed\Computop\Business\Api\Request\RequestInterface
     */
    public function createRefundPaymentRequest()
    {
        return $this->createApiFactory()->createRefundPaymentRequest();
    }

    /**
     * @return \SprykerEco\Zed\Computop\Business\Payment\Handler\ResponseHandlerInterface
     */
    public function createAuthorizeResponseHandler()
    {
        return new AuthorizeResponseHandler(
            $this->getQueryContainer(),
            $this->createComputopResponseLogger(),
            $this->getConfig(),
            $this->createAuthorizationPaymentRequest()
        );
    }

    /**
     * @return \SprykerEco\Zed\Computop\Business\Payment\Handler\ResponseHandlerInterface
     */
    public function createReverseResponseHandler()
    {
        return new ReverseResponseHandler(
            $this->getQueryContainer(),
            $this->createComputopResponseLogger(),
            $this->getConfig(),
            $this->createReversePaymentRequest()
        );
    }

    /**
     * @return \SprykerEco\Zed\Computop\Business\Payment\Handler\ResponseHandlerInterface
     */
    public function createInquireResponseHandler()
    {
        return new InquireResponseHandler(
            $this->getQueryContainer(),
            $this->createComputopResponseLogger(),
            $this->getConfig(),
            $this->createInquirePaymentRequest()
        );
    }

    /**
     * @return \SprykerEco\Zed\Computop\Business\Payment\Handler\ResponseHandlerInterface
     */
    public function createCaptureResponseHandler()
    {
        return new CaptureResponseHandler(
            $this->getQueryContainer(),
            $this->createComputopResponseLogger(),
            $this->getConfig(),
            $this->createCapturePaymentRequest()
        );
    }

    /**
     * @return \SprykerEco\Zed\Computop\Business\Payment\Handler\ResponseHandlerInterface
     */
    public function createRefundResponseHandler()
    {
        return new RefundResponseHandler(
            $this->getQueryContainer(),
            $this->createComputopResponseLogger(),
            $this->getConfig(),
            $this->createRefundPaymentRequest()
        );
    }

    /**
     * @return \SprykerEco\Zed\Computop\Business\Payment\Handler\Order\OrderResponseHandlerInterface
     */
    public function createSofortResponseHandler()
    {
        return new SofortResponseHandler($this->getQueryContainer(), $this->getOmsFacade(), $this->getConfig());
    }

    /**
     * @return \SprykerEco\Zed\Computop\Business\Payment\Handler\Order\OrderResponseHandlerInterface
     */
    public function createIdealResponseHandler()
    {
        return new IdealResponseHandler($this->getQueryContainer(), $this->getOmsFacade(), $this->getConfig());
    }

    /**
     * @return \SprykerEco\Zed\Computop\Business\Payment\Handler\Order\OrderResponseHandlerInterface
     */
    public function createPaydirektResponseHandler()
    {
        return new PaydirektResponseHandler($this->getQueryContainer(), $this->getOmsFacade(), $this->getConfig());
    }

    /**
     * @return \SprykerEco\Zed\Computop\Business\Payment\Handler\Logger\ComputopResponseLoggerInterface
     */
    public function createComputopResponseLogger()
    {
        return new ComputopResponseLogger();
    }

    /**
     * @return \SprykerEco\Zed\Computop\Business\Oms\Command\CancelItemManagerInterface
     */
    public function createCancelItemManager()
    {
        return new CancelItemManager($this->getQueryContainer(), $this->getConfig());
    }

    /**
     * @return \SprykerEco\Zed\Computop\Business\Order\ComputopBusinessOrderFactoryInterface
     */
    protected function createOrderFactory()
    {
        return new ComputopBusinessOrderFactory();
    }

    /**
     * @return \SprykerEco\Service\Computop\ComputopServiceInterface
     */
    protected function getComputopService()
    {
        return $this->getProvidedDependency(ComputopDependencyProvider::SERVICE_COMPUTOP);
    }

    /**
     * @return \SprykerEco\Zed\Computop\Dependency\Facade\ComputopToOmsFacadeInterface
     */
    protected function getOmsFacade()
    {
        return $this->getProvidedDependency(ComputopDependencyProvider::FACADE_OMS);
    }
}
