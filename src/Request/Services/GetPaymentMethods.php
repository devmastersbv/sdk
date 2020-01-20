<?php

declare(strict_types=1);

namespace PayNL\Sdk\Request\Services;

use PayNL\Sdk\{
    Exception\MissingParamException,
    Request\AbstractRequest,
    Request\Parameter\ServiceIdTrait
};

/**
 * Class GetPaymentMethods
 *
 * @package PayNL\Sdk\Request\Services
 */
class GetPaymentMethods extends AbstractRequest
{
    use ServiceIdTrait;

    /**
     * @inheritDoc
     */
    public function init(): void
    {
        $serviceId = (string)$this->getParam('serviceId');
        if (null === $serviceId) {
            throw new MissingParamException('Missing param!');
        }

        $this->setServiceId($serviceId);
    }

    /**
     * @inheritDoc
     */
    public function getUri(): string
    {
        return "services/{$this->getServiceId()}/paymentmethods";
    }

    /**
     * @inheritDoc
     */
    public function getMethod(): string
    {
        return static::METHOD_GET;
    }
}
