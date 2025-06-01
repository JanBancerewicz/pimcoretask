<?php

namespace Pimcore\Model\DataObject\Event;

use Pimcore\Model;
use Pimcore\Model\DataObject;

/**
 * @method DataObject\Event|false current()
 * @method DataObject\Event[] load()
 * @method DataObject\Event[] getData()
 * @method DataObject\Event[] getObjects()
 */

class Listing extends DataObject\Listing\Concrete
{
protected $classId = "EV";
protected $className = "Event";


/**
* Filter by title (title)
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
* Filter by description (Description)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByDescription ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("description")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by tags (Tags)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByTags ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("tags")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by locationAddress (Location Address)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByLocationAddress ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("locationAddress")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by status (Status)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByStatus ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("status")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by fromDate (Start)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByFromDate ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("fromDate")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by toDate (End)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByToDate ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("toDate")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by cars (Cars)
* @param mixed $data
* @param string $operator SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByCars ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("cars")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by mainImage (Image)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByMainImage ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("mainImage")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by contactName (Name)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByContactName ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("contactName")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by contactPhone (Phone)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByContactPhone ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("contactPhone")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by contactEmail (Email)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByContactEmail ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("contactEmail")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by contactAddress (Address)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByContactAddress ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("contactAddress")->addListingFilter($this, $data, $operator);
	return $this;
}



}
