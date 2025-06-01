<?php

/**
 * Inheritance: no
 * Variants: no
 *
 * Fields Summary:
 * - Nazwa [input]
 * - Sciezka [input]
 */

namespace Pimcore\Model\DataObject;

use Pimcore\Model\DataObject\Exception\InheritanceParentNotFoundException;
use Pimcore\Model\DataObject\PreGetValueHookInterface;

/**
* @method static \Pimcore\Model\DataObject\DocumentFile\Listing getList(array $config = [])
* @method static \Pimcore\Model\DataObject\DocumentFile\Listing|\Pimcore\Model\DataObject\DocumentFile|null getByNazwa(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\DocumentFile\Listing|\Pimcore\Model\DataObject\DocumentFile|null getBySciezka(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
*/

class DocumentFile extends Concrete
{
public const FIELD_NAZWA = 'Nazwa';
public const FIELD_SCIEZKA = 'Sciezka';

protected $classId = "7";
protected $className = "DocumentFile";
protected $Nazwa;
protected $Sciezka;


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
* Get Sciezka - Sciezka
* @return string|null
*/
public function getSciezka(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("Sciezka");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->Sciezka;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set Sciezka - Sciezka
* @param string|null $Sciezka
* @return $this
*/
public function setSciezka(?string $Sciezka): static
{
	$this->markFieldDirty("Sciezka", true);

	$this->Sciezka = $Sciezka;

	return $this;
}

}

