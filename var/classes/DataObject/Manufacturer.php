<?php

/**
 * Inheritance: no
 * Variants: no
 *
 * Fields Summary:
 * - name [input]
 * - logo [image]
 */

namespace Pimcore\Model\DataObject;

use Pimcore\Model\DataObject\Exception\InheritanceParentNotFoundException;
use Pimcore\Model\DataObject\PreGetValueHookInterface;

/**
* @method static \Pimcore\Model\DataObject\Manufacturer\Listing getList(array $config = [])
* @method static \Pimcore\Model\DataObject\Manufacturer\Listing|\Pimcore\Model\DataObject\Manufacturer|null getByName(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Manufacturer\Listing|\Pimcore\Model\DataObject\Manufacturer|null getByLogo(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
*/

class Manufacturer extends Concrete
{
public const FIELD_NAME = 'name';
public const FIELD_LOGO = 'logo';

protected $classId = "MA";
protected $className = "Manufacturer";
protected $name;
protected $logo;


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
* Get name - Name
* @return string|null
*/
public function getName(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("name");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->name;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set name - Name
* @param string|null $name
* @return $this
*/
public function setName(?string $name): static
{
	$this->markFieldDirty("name", true);

	$this->name = $name;

	return $this;
}

/**
* Get logo - Logo
* @return \Pimcore\Model\Asset\Image|null
*/
public function getLogo(): ?\Pimcore\Model\Asset\Image
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("logo");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->logo;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set logo - Logo
* @param \Pimcore\Model\Asset\Image|null $logo
* @return $this
*/
public function setLogo(?\Pimcore\Model\Asset\Image $logo): static
{
	$this->markFieldDirty("logo", true);

	$this->logo = $logo;

	return $this;
}

}

