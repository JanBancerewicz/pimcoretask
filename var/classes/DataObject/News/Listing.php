<?php

namespace Pimcore\Model\DataObject\News;

use Pimcore\Model;
use Pimcore\Model\DataObject;

/**
 * @method DataObject\News|false current()
 * @method DataObject\News[] load()
 * @method DataObject\News[] getData()
 * @method DataObject\News[] getObjects()
 */

class Listing extends DataObject\Listing\Concrete
{
protected $classId = "NE";
protected $className = "News";


/**
* Filter by title (Title)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByTitle ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("title")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by shortText (Short Text)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByShortText ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("shortText")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by date (Date)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByDate ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("date")->addListingFilter($this, $data, $operator);
	return $this;
}



}
