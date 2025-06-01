<?php

/**
 * Inheritance: no
 * Variants: no
 *
 * Fields Summary:
 * - SKU [input]
 * - Nazwa [input]
 * - Opis [wysiwyg]
 * - Cena [numeric]
 * - Status [select]
 * - Kategoria [manyToOneRelation]
 * - Producent [manyToOneRelation]
 * - Zdjecia [imageGallery]
 * - Dokumentacja [advancedManyToManyRelation]
 */

namespace Pimcore\Model\DataObject;

use Pimcore\Model\DataObject\Exception\InheritanceParentNotFoundException;
use Pimcore\Model\DataObject\PreGetValueHookInterface;

/**
* @method static \Pimcore\Model\DataObject\Product\Listing getList(array $config = [])
* @method static \Pimcore\Model\DataObject\Product\Listing|\Pimcore\Model\DataObject\Product|null getBySKU(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Product\Listing|\Pimcore\Model\DataObject\Product|null getByNazwa(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Product\Listing|\Pimcore\Model\DataObject\Product|null getByOpis(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Product\Listing|\Pimcore\Model\DataObject\Product|null getByCena(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Product\Listing|\Pimcore\Model\DataObject\Product|null getByStatus(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Product\Listing|\Pimcore\Model\DataObject\Product|null getByKategoria(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Product\Listing|\Pimcore\Model\DataObject\Product|null getByProducent(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Product\Listing|\Pimcore\Model\DataObject\Product|null getByDokumentacja(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
*/

class Product extends Concrete
{
public const FIELD_SKU = 'SKU';
public const FIELD_NAZWA = 'Nazwa';
public const FIELD_OPIS = 'Opis';
public const FIELD_CENA = 'Cena';
public const FIELD_STATUS = 'Status';
public const FIELD_KATEGORIA = 'Kategoria';
public const FIELD_PRODUCENT = 'Producent';
public const FIELD_ZDJECIA = 'Zdjecia';
public const FIELD_DOKUMENTACJA = 'Dokumentacja';

protected $classId = "6";
protected $className = "Product";
protected $SKU;
protected $Nazwa;
protected $Opis;
protected $Cena;
protected $Status;
protected $Kategoria;
protected $Producent;
protected $Zdjecia;
protected $Dokumentacja;


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
* Get SKU - SKU
* @return string|null
*/
public function getSKU(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("SKU");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->SKU;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set SKU - SKU
* @param string|null $SKU
* @return $this
*/
public function setSKU(?string $SKU): static
{
	$this->markFieldDirty("SKU", true);

	$this->SKU = $SKU;

	return $this;
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

	$data = $this->getClass()->getFieldDefinition("Opis")->preGetData($this);

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

/**
* Get Cena - Cena
* @return string|null
*/
public function getCena(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("Cena");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->Cena;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set Cena - Cena
* @param string|null $Cena
* @return $this
*/
public function setCena(?string $Cena): static
{
	/** @var \Pimcore\Model\DataObject\ClassDefinition\Data\Numeric $fd */
	$fd = $this->getClass()->getFieldDefinition("Cena");
	$this->Cena = $fd->preSetData($this, $Cena);
	return $this;
}

/**
* Get Status - Status dostepnosci
* @return string|null
*/
public function getStatus(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("Status");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->Status;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set Status - Status dostepnosci
* @param string|null $Status
* @return $this
*/
public function setStatus(?string $Status): static
{
	$this->markFieldDirty("Status", true);

	$this->Status = $Status;

	return $this;
}

/**
* Get Kategoria - Kategoria
* @return \Pimcore\Model\DataObject\CategoryItem|null
*/
public function getKategoria(): ?\Pimcore\Model\Element\AbstractElement
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("Kategoria");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->getClass()->getFieldDefinition("Kategoria")->preGetData($this);

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set Kategoria - Kategoria
* @param \Pimcore\Model\DataObject\CategoryItem|null $Kategoria
* @return $this
*/
public function setKategoria(?\Pimcore\Model\Element\AbstractElement $Kategoria): static
{
	/** @var \Pimcore\Model\DataObject\ClassDefinition\Data\ManyToOneRelation $fd */
	$fd = $this->getClass()->getFieldDefinition("Kategoria");
	$hideUnpublished = \Pimcore\Model\DataObject\Concrete::getHideUnpublished();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished(false);
	$currentData = $this->getKategoria();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished($hideUnpublished);
	$isEqual = $fd->isEqual($currentData, $Kategoria);
	if (!$isEqual) {
		$this->markFieldDirty("Kategoria", true);
	}
	$this->Kategoria = $fd->preSetData($this, $Kategoria);
	return $this;
}

/**
* Get Producent - Producent
* @return \Pimcore\Model\DataObject\ProducentInfo|null
*/
public function getProducent(): ?\Pimcore\Model\Element\AbstractElement
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("Producent");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->getClass()->getFieldDefinition("Producent")->preGetData($this);

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set Producent - Producent
* @param \Pimcore\Model\DataObject\ProducentInfo|null $Producent
* @return $this
*/
public function setProducent(?\Pimcore\Model\Element\AbstractElement $Producent): static
{
	/** @var \Pimcore\Model\DataObject\ClassDefinition\Data\ManyToOneRelation $fd */
	$fd = $this->getClass()->getFieldDefinition("Producent");
	$hideUnpublished = \Pimcore\Model\DataObject\Concrete::getHideUnpublished();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished(false);
	$currentData = $this->getProducent();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished($hideUnpublished);
	$isEqual = $fd->isEqual($currentData, $Producent);
	if (!$isEqual) {
		$this->markFieldDirty("Producent", true);
	}
	$this->Producent = $fd->preSetData($this, $Producent);
	return $this;
}

/**
* Get Zdjecia - Zdjecia
* @return \Pimcore\Model\DataObject\Data\ImageGallery|null
*/
public function getZdjecia(): ?\Pimcore\Model\DataObject\Data\ImageGallery
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("Zdjecia");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->Zdjecia;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set Zdjecia - Zdjecia
* @param \Pimcore\Model\DataObject\Data\ImageGallery|null $Zdjecia
* @return $this
*/
public function setZdjecia(?\Pimcore\Model\DataObject\Data\ImageGallery $Zdjecia): static
{
	$this->markFieldDirty("Zdjecia", true);

	$this->Zdjecia = $Zdjecia;

	return $this;
}

/**
* Get Dokumentacja - Dokumentacja
* @return \Pimcore\Model\DataObject\Data\ElementMetadata[]
*/
public function getDokumentacja(): array
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("Dokumentacja");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->getClass()->getFieldDefinition("Dokumentacja")->preGetData($this);

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set Dokumentacja - Dokumentacja
* @param \Pimcore\Model\DataObject\Data\ElementMetadata[] $Dokumentacja
* @return $this
*/
public function setDokumentacja(?array $Dokumentacja): static
{
	/** @var \Pimcore\Model\DataObject\ClassDefinition\Data\AdvancedManyToManyRelation $fd */
	$fd = $this->getClass()->getFieldDefinition("Dokumentacja");
	$hideUnpublished = \Pimcore\Model\DataObject\Concrete::getHideUnpublished();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished(false);
	$currentData = $this->getDokumentacja();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished($hideUnpublished);
	$isEqual = $fd->isEqual($currentData, $Dokumentacja);
	if (!$isEqual) {
		$this->markFieldDirty("Dokumentacja", true);
	}
	$this->Dokumentacja = $fd->preSetData($this, $Dokumentacja);
	return $this;
}

}

