<?php

namespace Pimcore\Model\DataObject\FilterDefinition;

use Pimcore\Model;
use Pimcore\Model\DataObject;

/**
 * @method DataObject\FilterDefinition|false current()
 * @method DataObject\FilterDefinition[] load()
 * @method DataObject\FilterDefinition[] getData()
 * @method DataObject\FilterDefinition[] getObjects()
 */

class Listing extends DataObject\Listing\Concrete
{
protected $classId = "EF_FD";
protected $className = "FilterDefinition";


/**
* Filter by pageLimit (Results per Page)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByPageLimit ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("pageLimit")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by defaultOrderByInheritance (inherit Default OrderBy)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByDefaultOrderByInheritance ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("defaultOrderByInheritance")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by orderByAsc (OrderBy)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByOrderByAsc ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("orderByAsc")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by orderByDesc (OrderBy Descending)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByOrderByDesc ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("orderByDesc")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by ajaxReload (ajaxReload)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByAjaxReload ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("ajaxReload")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by infiniteScroll (Infinite Scroll)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByInfiniteScroll ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("infiniteScroll")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by limitOnFirstLoad (Limit on First Load)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByLimitOnFirstLoad ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("limitOnFirstLoad")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by conditionsInheritance (inherit Conditions)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByConditionsInheritance ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("conditionsInheritance")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by filtersInheritance (inherit Filters)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByFiltersInheritance ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("filtersInheritance")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by crossSellingCategory (Base category for recommendations)
* @param mixed $data
* @param string $operator SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByCrossSellingCategory ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("crossSellingCategory")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by similarityFieldsInheritance (inherit SimilarityFields)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterBySimilarityFieldsInheritance ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("similarityFieldsInheritance")->addListingFilter($this, $data, $operator);
	return $this;
}



}
