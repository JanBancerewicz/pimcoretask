<?php

namespace Pimcore\Model\DataObject\OfferToolCustomProduct;

use Pimcore\Model;
use Pimcore\Model\DataObject;

/**
 * @method DataObject\OfferToolCustomProduct|false current()
 * @method DataObject\OfferToolCustomProduct[] load()
 * @method DataObject\OfferToolCustomProduct[] getData()
 * @method DataObject\OfferToolCustomProduct[] getObjects()
 */

class Listing extends DataObject\Listing\Concrete
{
protected $classId = "EF_OTCP";
protected $className = "OfferToolCustomProduct";


/**
* Filter by OSproductNumber (Product Number)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByOSproductNumber ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("OSproductNumber")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by OSName (Product Name)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByOSName ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("OSName")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by productGroup (Product Group)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByProductGroup ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("productGroup")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by price (Price)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByPrice ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("price")->addListingFilter($this, $data, $operator);
	return $this;
}



}
