<?php

/**
 * Inheritance: no
 * Variants: no
 *
 * Fields Summary:
 * - Kategoria [input]
 * - Opis [textarea]
 */

namespace Pimcore\Model\DataObject;

use Pimcore\Model\DataObject\Exception\InheritanceParentNotFoundException;
use Pimcore\Model\DataObject\PreGetValueHookInterface;

/**
* @method static \Pimcore\Model\DataObject\CategoryItem\Listing getList(array $config = [])
* @method static \Pimcore\Model\DataObject\CategoryItem\Listing|\Pimcore\Model\DataObject\CategoryItem|null getByKategoria(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\CategoryItem\Listing|\Pimcore\Model\DataObject\CategoryItem|null getByOpis(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
*/

class CategoryItem extends Concrete
{
public const FIELD_KATEGORIA = 'Kategoria';
public const FIELD_OPIS = 'Opis';

protected $classId = "8";
protected $className = "CategoryItem";
protected $Kategoria;
protected $Opis;


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
* Get Kategoria - Kategoria
* @return string|null
*/
public function getKategoria(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("Kategoria");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->Kategoria;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set Kategoria - Kategoria
* @param string|null $Kategoria
* @return $this
*/
public function setKategoria(?string $Kategoria): static
{
	$this->markFieldDirty("Kategoria", true);

	$this->Kategoria = $Kategoria;

	return $this;
}

/**
* Get Opis - Opis
* @return string|null
*/
public function getOpis(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("Opis");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->Opis;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set Opis - Opis
* @param string|null $Opis
* @return $this
*/
public function setOpis(?string $Opis): static
{
	$this->markFieldDirty("Opis", true);

	$this->Opis = $Opis;

	return $this;
}

}

