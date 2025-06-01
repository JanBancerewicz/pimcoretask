<?php

/**
 * Fields Summary:
 * - token [input]
 * - usages [numeric]
 * - onlyTokenPerCart [checkbox]
 */

namespace Pimcore\Model\DataObject\Fieldcollection\Data;

use Pimcore\Model\DataObject;
use Pimcore\Model\DataObject\PreGetValueHookInterface;

class VoucherTokenTypeSingle extends \Pimcore\Bundle\EcommerceFrameworkBundle\Model\AbstractVoucherTokenType
{
public const FIELD_TOKEN = 'token';
public const FIELD_USAGES = 'usages';
public const FIELD_ONLY_TOKEN_PER_CART = 'onlyTokenPerCart';

protected string $type = "VoucherTokenTypeSingle";
protected $token;
protected $usages;
protected $onlyTokenPerCart;


/**
* Get token - Token
* @return string|null
*/
public function getToken(): ?string
{
	$data = $this->token;
	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set token - Token
* @param string|null $token
* @return $this
*/
public function setToken(?string $token): static
{
	$this->token = $token;

	return $this;
}

/**
* Get usages - Usage count
* @return string|null
*/
public function getUsages(): ?string
{
	$data = $this->usages;
	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set usages - Usage count
* @param string|null $usages
* @return $this
*/
public function setUsages(?string $usages): static
{
	/** @var \Pimcore\Model\DataObject\ClassDefinition\Data\Numeric $fd */
	$fd = $this->getDefinition()->getFieldDefinition("usages");
	$this->usages = $fd->preSetData($this, $usages);
	return $this;
}

/**
* Get onlyTokenPerCart - Only token of a cart
* @return bool|null
*/
public function getOnlyTokenPerCart(): ?bool
{
	$data = $this->onlyTokenPerCart;
	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set onlyTokenPerCart - Only token of a cart
* @param bool|null $onlyTokenPerCart
* @return $this
*/
public function setOnlyTokenPerCart(?bool $onlyTokenPerCart): static
{
	$this->onlyTokenPerCart = $onlyTokenPerCart;

	return $this;
}

}

