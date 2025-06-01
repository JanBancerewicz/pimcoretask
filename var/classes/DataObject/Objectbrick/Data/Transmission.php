<?php

/**
 * Fields Summary:
 * - wheelDrive [select]
 */

namespace Pimcore\Model\DataObject\Objectbrick\Data;

use Pimcore\Model\DataObject;
use Pimcore\Model\DataObject\Exception\InheritanceParentNotFoundException;
use Pimcore\Model\DataObject\PreGetValueHookInterface;


class Transmission extends DataObject\Objectbrick\Data\AbstractData
{
public const FIELD_WHEEL_DRIVE = 'wheelDrive';

protected string $type = "Transmission";
protected $wheelDrive;


/**
* Transmission constructor.
* @param DataObject\Concrete $object
*/
public function __construct(DataObject\Concrete $object)
{
	parent::__construct($object);
	$this->markFieldDirty("_self");
}


/**
* Get wheelDrive - Wheel Drive
* @return string|null
*/
public function getWheelDrive(): ?string
{
	$data = $this->wheelDrive;
	if(\Pimcore\Model\DataObject::doGetInheritedValues($this->getObject()) && $this->getDefinition()->getFieldDefinition("wheelDrive")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("wheelDrive");
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
* Set wheelDrive - Wheel Drive
* @param string|null $wheelDrive
* @return $this
*/
public function setWheelDrive (?string $wheelDrive): static
{
	$this->wheelDrive = $wheelDrive;

	return $this;
}

}

