<?php

/**
 * Inheritance: no
 * Variants: no
 *
 * Fields Summary:
 * - OSproductNumber [input]
 * - OSName [input]
 * - productGroup [select]
 * - price [numeric]
 */

namespace Pimcore\Model\DataObject;

use Pimcore\Model\DataObject\Exception\InheritanceParentNotFoundException;
use Pimcore\Model\DataObject\PreGetValueHookInterface;

/**
* @method static \Pimcore\Model\DataObject\OfferToolCustomProduct\Listing getList(array $config = [])
* @method static \Pimcore\Model\DataObject\OfferToolCustomProduct\Listing|\Pimcore\Model\DataObject\OfferToolCustomProduct|null getByOSproductNumber(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\OfferToolCustomProduct\Listing|\Pimcore\Model\DataObject\OfferToolCustomProduct|null getByOSName(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\OfferToolCustomProduct\Listing|\Pimcore\Model\DataObject\OfferToolCustomProduct|null getByProductGroup(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\OfferToolCustomProduct\Listing|\Pimcore\Model\DataObject\OfferToolCustomProduct|null getByPrice(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
*/

class OfferToolCustomProduct extends \Pimcore\Bundle\EcommerceFrameworkBundle\OfferTool\AbstractOfferToolProduct
{
public const FIELD_OSPRODUCT_NUMBER = 'OSproductNumber';
public const FIELD_OSNAME = 'OSName';
public const FIELD_PRODUCT_GROUP = 'productGroup';
public const FIELD_PRICE = 'price';

protected $classId = "EF_OTCP";
protected $className = "OfferToolCustomProduct";
protected $OSproductNumber;
protected $OSName;
protected $productGroup;
protected $price;


/**
* @param array $values
* @return static
*/
public static function create(array $values = []): static
{
	$object = new static();
	$object->setValues($values);
	return $object;
}

/**
* Get OSproductNumber - Product Number
* @return string|null
*/
public function getOSproductNumber(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("OSproductNumber");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->OSproductNumber;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set OSproductNumber - Product Number
* @param string|null $OSproductNumber
* @return $this
*/
public function setOSproductNumber(?string $OSproductNumber): static
{
	$this->markFieldDirty("OSproductNumber", true);

	$this->OSproductNumber = $OSproductNumber;

	return $this;
}

/**
* Get OSName - Product Name
* @return string|null
*/
public function getOSName(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("OSName");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->OSName;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set OSName - Product Name
* @param string|null $OSName
* @return $this
*/
public function setOSName(?string $OSName): static
{
	$this->markFieldDirty("OSName", true);

	$this->OSName = $OSName;

	return $this;
}

/**
* Get productGroup - Product Group
* @return string|null
*/
public function getProductGroup(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("productGroup");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->productGroup;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set productGroup - Product Group
* @param string|null $productGroup
* @return $this
*/
public function setProductGroup(?string $productGroup): static
{
	$this->markFieldDirty("productGroup", true);

	$this->productGroup = $productGroup;

	return $this;
}

/**
* Get price - Price
* @return string|null
*/
public function getPrice(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("price");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->price;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set price - Price
* @param string|null $price
* @return $this
*/
public function setPrice(?string $price): static
{
	/** @var \Pimcore\Model\DataObject\ClassDefinition\Data\Numeric $fd */
	$fd = $this->getClass()->getFieldDefinition("price");
	$this->price = $fd->preSetData($this, $price);
	return $this;
}

}

