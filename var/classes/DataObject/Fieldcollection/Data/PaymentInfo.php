<?php

/**
 * Fields Summary:
 * - paymentStart [datetime]
 * - paymentFinish [datetime]
 * - paymentReference [input]
 * - paymentState [select]
 * - internalPaymentId [input]
 * - message [textarea]
 * - providerData [textarea]
 * - provider_paypal_amount [input]
 * - provider_paypal_PaymentType [input]
 */

namespace Pimcore\Model\DataObject\Fieldcollection\Data;

use Pimcore\Model\DataObject;
use Pimcore\Model\DataObject\PreGetValueHookInterface;

class PaymentInfo extends \Pimcore\Bundle\EcommerceFrameworkBundle\Model\AbstractPaymentInformation
{
public const FIELD_PAYMENT_START = 'paymentStart';
public const FIELD_PAYMENT_FINISH = 'paymentFinish';
public const FIELD_PAYMENT_REFERENCE = 'paymentReference';
public const FIELD_PAYMENT_STATE = 'paymentState';
public const FIELD_INTERNAL_PAYMENT_ID = 'internalPaymentId';
public const FIELD_MESSAGE = 'message';
public const FIELD_PROVIDER_DATA = 'providerData';
public const FIELD_PROVIDER_PAYPAL_AMOUNT = 'provider_paypal_amount';
public const FIELD_PROVIDER_PAYPAL__PAYMENT_TYPE = 'provider_paypal_PaymentType';

protected string $type = "PaymentInfo";
protected $paymentStart;
protected $paymentFinish;
protected $paymentReference;
protected $paymentState;
protected $internalPaymentId;
protected $message;
protected $providerData;
protected $provider_paypal_amount;
protected $provider_paypal_PaymentType;


/**
* Get paymentStart - Payment Start
* @return \Carbon\Carbon|null
*/
public function getPaymentStart(): ?\Carbon\Carbon
{
	$data = $this->paymentStart;
	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set paymentStart - Payment Start
* @param \Carbon\Carbon|null $paymentStart
* @return $this
*/
public function setPaymentStart(?\Carbon\Carbon $paymentStart): static
{
	$this->paymentStart = $paymentStart;

	return $this;
}

/**
* Get paymentFinish - Payment Finish
* @return \Carbon\Carbon|null
*/
public function getPaymentFinish(): ?\Carbon\Carbon
{
	$data = $this->paymentFinish;
	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set paymentFinish - Payment Finish
* @param \Carbon\Carbon|null $paymentFinish
* @return $this
*/
public function setPaymentFinish(?\Carbon\Carbon $paymentFinish): static
{
	$this->paymentFinish = $paymentFinish;

	return $this;
}

/**
* Get paymentReference - Payment Reference
* @return string|null
*/
public function getPaymentReference(): ?string
{
	$data = $this->paymentReference;
	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set paymentReference - Payment Reference
* @param string|null $paymentReference
* @return $this
*/
public function setPaymentReference(?string $paymentReference): static
{
	$this->paymentReference = $paymentReference;

	return $this;
}

/**
* Get paymentState - Payment State
* @return string|null
*/
public function getPaymentState(): ?string
{
	$data = $this->paymentState;
	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set paymentState - Payment State
* @param string|null $paymentState
* @return $this
*/
public function setPaymentState(?string $paymentState): static
{
	$this->paymentState = $paymentState;

	return $this;
}

/**
* Get internalPaymentId - Internal Payment ID
* @return string|null
*/
public function getInternalPaymentId(): ?string
{
	$data = $this->internalPaymentId;
	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set internalPaymentId - Internal Payment ID
* @param string|null $internalPaymentId
* @return $this
*/
public function setInternalPaymentId(?string $internalPaymentId): static
{
	$this->internalPaymentId = $internalPaymentId;

	return $this;
}

/**
* Get message - Message
* @return string|null
*/
public function getMessage(): ?string
{
	$data = $this->message;
	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set message - Message
* @param string|null $message
* @return $this
*/
public function setMessage(?string $message): static
{
	$this->message = $message;

	return $this;
}

/**
* Get providerData - Provider Data
* @return string|null
*/
public function getProviderData(): ?string
{
	$data = $this->providerData;
	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set providerData - Provider Data
* @param string|null $providerData
* @return $this
*/
public function setProviderData(?string $providerData): static
{
	$this->providerData = $providerData;

	return $this;
}

/**
* Get provider_paypal_amount - Amount
* @return string|null
*/
public function getProvider_paypal_amount(): ?string
{
	$data = $this->provider_paypal_amount;
	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set provider_paypal_amount - Amount
* @param string|null $provider_paypal_amount
* @return $this
*/
public function setProvider_paypal_amount(?string $provider_paypal_amount): static
{
	$this->provider_paypal_amount = $provider_paypal_amount;

	return $this;
}

/**
* Get provider_paypal_PaymentType - Payment Type
* @return string|null
*/
public function getProvider_paypal_PaymentType(): ?string
{
	$data = $this->provider_paypal_PaymentType;
	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set provider_paypal_PaymentType - Payment Type
* @param string|null $provider_paypal_PaymentType
* @return $this
*/
public function setProvider_paypal_PaymentType(?string $provider_paypal_PaymentType): static
{
	$this->provider_paypal_PaymentType = $provider_paypal_PaymentType;

	return $this;
}

}

