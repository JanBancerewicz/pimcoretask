<?php

namespace Pimcore\Model\DataObject\ProducentInfo;

use Pimcore\Model;
use Pimcore\Model\DataObject;

/**
 * @method DataObject\ProducentInfo|false current()
 * @method DataObject\ProducentInfo[] load()
 * @method DataObject\ProducentInfo[] getData()
 * @method DataObject\ProducentInfo[] getObjects()
 */

class Listing extends DataObject\Listing\Concrete
{
protected $classId = "9";
protected $className = "ProducentInfo";


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
* Filter by NIP (NIP)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByNIP ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("NIP")->addListingFilter($this, $data, $operator);
	return $this;
}



}
