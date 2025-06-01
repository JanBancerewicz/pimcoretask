<?php

namespace Pimcore\Model\DataObject\CategoryItem;

use Pimcore\Model;
use Pimcore\Model\DataObject;

/**
 * @method DataObject\CategoryItem|false current()
 * @method DataObject\CategoryItem[] load()
 * @method DataObject\CategoryItem[] getData()
 * @method DataObject\CategoryItem[] getObjects()
 */

class Listing extends DataObject\Listing\Concrete
{
protected $classId = "8";
protected $className = "CategoryItem";


/**
* Filter by Kategoria (Kategoria)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByKategoria ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("Kategoria")->addListingFilter($this, $data, $operator);
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



}
