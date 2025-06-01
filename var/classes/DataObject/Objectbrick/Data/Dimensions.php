<?php

/**
 * Fields Summary:
 * - length [quantityValue]
 * - width [quantityValue]
 * - wheelbase [quantityValue]
 * - weight [quantityValue]
 */

namespace Pimcore\Model\DataObject\Objectbrick\Data;

use Pimcore\Model\DataObject;
use Pimcore\Model\DataObject\Exception\InheritanceParentNotFoundException;
use Pimcore\Model\DataObject\PreGetValueHookInterface;


class Dimensions extends DataObject\Objectbrick\Data\AbstractData
{
public const FIELD_LENGTH = 'length';
public const FIELD_WIDTH = 'width';
public const FIELD_WHEELBASE = 'wheelbase';
public const FIELD_WEIGHT = 'weight';

protected string $type = "Dimensions";
protected $length;
protected $width;
protected $wheelbase;
protected $weight;


/**
* Dimensions constructor.
* @param DataObject\Concrete $object
*/
public function __construct(DataObject\Concrete $object)
{
	parent::__construct($object);
	$this->markFieldDirty("_self");
}


/**
* Get length - Length
* @return \Pimcore\Model\DataObject\Data\QuantityValue|null
*/
public function getLength(): ?\Pimcore\Model\DataObject\Data\QuantityValue
{
	$data = $this->length;
	if(\Pimcore\Model\DataObject::doGetInheritedValues($this->getObject()) && $this->getDefinition()->getFieldDefinition("length")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("length");
		} catch (InheritanceParentNotFoundException $e) {
			// no data from parent available, continue ...
		}
	}
	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set length - Length
* @param \Pimcore\Model\DataObject\Data\QuantityValue|null $length
* @return $this
*/
public function setLength (?\Pimcore\Model\DataObject\Data\QuantityValue $length): static
{
	$this->length = $length;

	return $this;
}

/**
* Get width - Width
* @return \Pimcore\Model\DataObject\Data\QuantityValue|null
*/
public function getWidth(): ?\Pimcore\Model\DataObject\Data\QuantityValue
{
	$data = $this->width;
	if(\Pimcore\Model\DataObject::doGetInheritedValues($this->getObject()) && $this->getDefinition()->getFieldDefinition("width")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("width");
		} catch (InheritanceParentNotFoundException $e) {
			// no data from parent available, continue ...
		}
	}
	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set width - Width
* @param \Pimcore\Model\DataObject\Data\QuantityValue|null $width
* @return $this
*/
public function setWidth (?\Pimcore\Model\DataObject\Data\QuantityValue $width): static
{
	$this->width = $width;

	return $this;
}

/**
* Get wheelbase - Wheelbase
* @return \Pimcore\Model\DataObject\Data\QuantityValue|null
*/
public function getWheelbase(): ?\Pimcore\Model\DataObject\Data\QuantityValue
{
	$data = $this->wheelbase;
	if(\Pimcore\Model\DataObject::doGetInheritedValues($this->getObject()) && $this->getDefinition()->getFieldDefinition("wheelbase")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("wheelbase");
		} catch (InheritanceParentNotFoundException $e) {
			// no data from parent available, continue ...
		}
	}
	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set wheelbase - Wheelbase
* @param \Pimcore\Model\DataObject\Data\QuantityValue|null $wheelbase
* @return $this
*/
public function setWheelbase (?\Pimcore\Model\DataObject\Data\QuantityValue $wheelbase): static
{
	$this->wheelbase = $wheelbase;

	return $this;
}

/**
* Get weight - Weight
* @return \Pimcore\Model\DataObject\Data\QuantityValue|null
*/
public function getWeight(): ?\Pimcore\Model\DataObject\Data\QuantityValue
{
	$data = $this->weight;
	if(\Pimcore\Model\DataObject::doGetInheritedValues($this->getObject()) && $this->getDefinition()->getFieldDefinition("weight")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("weight");
		} catch (InheritanceParentNotFoundException $e) {
			// no data from parent available, continue ...
		}
	}
	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set weight - Weight
* @param \Pimcore\Model\DataObject\Data\QuantityValue|null $weight
* @return $this
*/
public function setWeight (?\Pimcore\Model\DataObject\Data\QuantityValue $weight): static
{
	$this->weight = $weight;

	return $this;
}

}

