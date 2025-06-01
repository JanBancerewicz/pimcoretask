<?php

/**
 * Inheritance: no
 * Variants: no
 *
 * Fields Summary:
 * - Nazwa [input]
 * - NIP [input]
 */

namespace Pimcore\Model\DataObject;

use Pimcore\Model\DataObject\Exception\InheritanceParentNotFoundException;
use Pimcore\Model\DataObject\PreGetValueHookInterface;

/**
* @method static \Pimcore\Model\DataObject\ProducentInfo\Listing getList(array $config = [])
* @method static \Pimcore\Model\DataObject\ProducentInfo\Listing|\Pimcore\Model\DataObject\ProducentInfo|null getByNazwa(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\ProducentInfo\Listing|\Pimcore\Model\DataObject\ProducentInfo|null getByNIP(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
*/

class ProducentInfo extends Concrete
{
public const FIELD_NAZWA = 'Nazwa';
public const FIELD_NIP = 'NIP';

protected $classId = "9";
protected $className = "ProducentInfo";
protected $Nazwa;
protected $NIP;


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
* Get Nazwa - Nazwa
* @return string|null
*/
public function getNazwa(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("Nazwa");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->Nazwa;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set Nazwa - Nazwa
* @param string|null $Nazwa
* @return $this
*/
public function setNazwa(?string $Nazwa): static
{
	$this->markFieldDirty("Nazwa", true);

	$this->Nazwa = $Nazwa;

	return $this;
}

/**
* Get NIP - NIP
* @return string|null
*/
public function getNIP(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("NIP");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->NIP;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set NIP - NIP
* @param string|null $NIP
* @return $this
*/
public function setNIP(?string $NIP): static
{
	$this->markFieldDirty("NIP", true);

	$this->NIP = $NIP;

	return $this;
}

}

