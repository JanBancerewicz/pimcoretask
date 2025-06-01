<?php

namespace Pimcore\Model\DataObject\DocumentFile;

use Pimcore\Model;
use Pimcore\Model\DataObject;

/**
 * @method DataObject\DocumentFile|false current()
 * @method DataObject\DocumentFile[] load()
 * @method DataObject\DocumentFile[] getData()
 * @method DataObject\DocumentFile[] getObjects()
 */

class Listing extends DataObject\Listing\Concrete
{
protected $classId = "7";
protected $className = "DocumentFile";


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
* Filter by Sciezka (Sciezka)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterBySciezka ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("Sciezka")->addListingFilter($this, $data, $operator);
	return $this;
}



}
