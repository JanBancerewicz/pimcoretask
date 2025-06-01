<?php

namespace Pimcore\Model\DataObject\AccessoryPart;

use Pimcore\Model;
use Pimcore\Model\DataObject;

/**
 * @method DataObject\AccessoryPart|false current()
 * @method DataObject\AccessoryPart[] load()
 * @method DataObject\AccessoryPart[] getData()
 * @method DataObject\AccessoryPart[] getObjects()
 */

class Listing extends DataObject\Listing\Concrete
{
protected $classId = "AP";
protected $className = "AccessoryPart";


/**
* Filter by generatedName (Fullname)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByGeneratedName ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("generatedName")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by nameAddition (Name Addition)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByNameAddition ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("nameAddition")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by manufacturer (Manufacturer)
* @param mixed $data
* @param string $operator SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByManufacturer ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("manufacturer")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by series (Series)
* @param mixed $data
* @param string $operator SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterBySeries ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("series")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by mainCategory (Main Category)
* @param mixed $data
* @param string $operator SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByMainCategory ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("mainCategory")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by compatibleTo (Compatible To)
* @param mixed $data
* @param string $operator SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByCompatibleTo ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("compatibleTo")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by additionalCategories (Additional Categories)
* @param mixed $data
* @param string $operator SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByAdditionalCategories ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("additionalCategories")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by erpNumber (ERP Number)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByErpNumber ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("erpNumber")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by categoryCode (Category Code)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByCategoryCode ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("categoryCode")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by owner (Owner)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByOwner ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("owner")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by urlSlug (UrlSlug)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByUrlSlug ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("urlSlug")->addListingFilter($this, $data, $operator);
	return $this;
}



}
