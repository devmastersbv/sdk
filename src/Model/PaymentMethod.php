<?php

declare(strict_types=1);

namespace PayNL\Sdk\Model;

use JsonSerializable;
use PayNL\Sdk\Exception\InvalidArgumentException;

/**
 * Class PaymentMethod
 *
 * @package PayNL\Sdk\Model
 */
class PaymentMethod implements ModelInterface, JsonSerializable
{
    use JsonSerializeTrait;

    /**
     * @required
     *
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $subId = '';

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $image;

    /**
     * @var array
     */
    protected $countryCodes = [];

    /**
     * @var PaymentMethods
     */
    protected $subMethods;

    /**
     * PaymentMethod constructor.
     */
    public function __construct()
    {
        $this->subMethods = new PaymentMethods();
    }

    /**
     * @return integer
     */
    public function getId(): int
    {
        return (int)$this->id;
    }

    /**
     * @param integer $id
     *
     * @return PaymentMethod
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubId(): string
    {
        return (string)$this->subId;
    }

    /**
     * @param mixed $subId
     *
     * @throws InvalidArgumentException when given $subId is not a string nor an integer
     *
     * @return PaymentMethod
     */
    public function setSubId($subId): self
    {
        if (true === is_int($subId)) {
            $subId = (string)$subId;
        } elseif (false === is_string($subId)) {
            throw new InvalidArgumentException(
                sprintf(
                    '%s expects argument given to be a string or integer, %s given',
                    __METHOD__,
                    is_object($subId) === true ? get_class($subId) : gettype($subId)
                )
            );
        }

        $this->subId = $subId;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return (string)$this->name;
    }

    /**
     * @param string $name
     *
     * @return PaymentMethod
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return (string)$this->image;
    }

    /**
     * @param string $image
     *
     * @return PaymentMethod
     */
    public function setImage(string $image): self
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return array
     */
    public function getCountryCodes(): array
    {
        return $this->countryCodes;
    }

    /**
     * @param array $countryCodes
     *
     * @return PaymentMethod
     */
    public function setCountryCodes(array $countryCodes): self
    {
        if (0 === count($countryCodes)) {
            return $this;
        }

        foreach ($countryCodes as $countryCode) {
            $this->addCountryCode($countryCode);
        }
        return $this;
    }

    /**
     * @param string $countryCode
     *
     * @return $this
     */
    public function addCountryCode(string $countryCode): self
    {
        $this->countryCodes[] = $countryCode;
        $this->countryCodes = array_unique($this->countryCodes);
        return $this;
    }

    /**
     * @return PaymentMethods
     */
    public function getSubMethods(): PaymentMethods
    {
        return $this->subMethods;
    }

    /**
     * @param PaymentMethods $subMethods
     *
     * @return PaymentMethod
     */
    public function setSubMethods(PaymentMethods $subMethods): self
    {
        $this->subMethods = $subMethods;

        return $this;
    }

    public function addSubMethod(self $paymentMethod): self
    {
        $this->subMethods->addPaymentMethod($paymentMethod);
        return $this;
    }
}
