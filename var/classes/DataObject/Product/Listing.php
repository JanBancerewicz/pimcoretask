<?php

namespace Pimcore\Model\DataObject\Product;

use Pimcore\Model;
use Pimcore\Model\DataObject;

/**
 * @method DataObject\Product|false current()
 * @method DataObject\Product[] load()
 * @method DataObject\Product[] getData()
 * @method DataObject\Product[] getObjects()
 */

class Listing extends DataObject\Listing\Concrete
{
protected $classId = "6";
protected $className = "Product";


/**
* Filter by SKU (SKU)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterBySKU ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("SKU")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by Nazwa (Nazwa)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByNazwa ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("Nazwa")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by Opis (Opis)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByOpis ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("Opis")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by Cena (Cena)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByCena ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("Cena")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by Status (Status dostepnosci)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByStatus ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("Status")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by Kategoria (Kategoria)
* @param mixed $data
* @param string $operator SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByKategoria ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("Kategoria")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by Producent (Producent)
* @param mixed $data
* @param string $operator SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByProducent ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("Producent")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by Dokumentacja (Dokumentacja)
* @param mixed $data
* @param string $operator SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByDokumentacja ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("Dokumentacja")->addListingFilter($this, $data, $operator);
	return $this;
}



}
