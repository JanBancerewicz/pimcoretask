<?php

/**
 * Inheritance: yes
 * Variants: no
 *
 * Fields Summary:
 * - localizedfields [localizedfields]
 * -- name [input]
 * -- productNamePart [input]
 * - filterDefinition [manyToOneRelation]
 * - cars [reverseObjectRelation]
 */

namespace Pimcore\Model\DataObject;

use Pimcore\Model\DataObject\Exception\InheritanceParentNotFoundException;
use Pimcore\Model\DataObject\PreGetValueHookInterface;

/**
* @method static \Pimcore\Model\DataObject\Category\Listing getList(array $config = [])
* @method static \Pimcore\Model\DataObject\Category\Listing|\Pimcore\Model\DataObject\Category|null getByLocalizedfields(string $field, mixed $value, ?string $locale = null, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Category\Listing|\Pimcore\Model\DataObject\Category|null getByName(mixed $value, ?string $locale = null, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Category\Listing|\Pimcore\Model\DataObject\Category|null getByProductNamePart(mixed $value, ?string $locale = null, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Category\Listing|\Pimcore\Model\DataObject\Category|null getByFilterDefinition(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Category\Listing|\Pimcore\Model\DataObject\Category|null getByCars(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
*/

class Category extends \Pimcore\Bundle\EcommerceFrameworkBundle\Model\AbstractCategory
{
public const FIELD_NAME = 'name';
public const FIELD_PRODUCT_NAME_PART = 'productNamePart';
public const FIELD_FILTER_DEFINITION = 'filterDefinition';
public const FIELD_CARS = 'cars';

protected $classId = "CA";
protected $className = "Category";
protected $localizedfields;
protected $filterDefinition;


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
* Get localizedfields - Texts
* @return \Pimcore\Model\DataObject\Localizedfield|null
*/
public function getLocalizedfields(): ?\Pimcore\Model\DataObject\Localizedfield
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("localizedfields");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->getClass()->getFieldDefinition("localizedfields")->preGetData($this);

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("localizedfields")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("localizedfields");
		} catch (InheritanceParentNotFoundException $e) {
			// no data from parent available, continue ...
		}
	}

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Get name - Name
* @return string|null
*/
public function getName(?string $language = null): ?string
{
	$data = $this->getLocalizedfields()->getLocalizedValue("name", $language);
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("name");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Get productNamePart - Product Name Part
* @return string|null
*/
public function getProductNamePart(?string $language = null): ?string
{
	$data = $this->getLocalizedfields()->getLocalizedValue("productNamePart", $language);
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("productNamePart");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set localizedfields - Texts
* @param \Pimcore\Model\DataObject\Localizedfield|null $localizedfields
* @return $this
*/
public function setLocalizedfields(?\Pimcore\Model\DataObject\Localizedfield $localizedfields): static
{
	$hideUnpublished = \Pimcore\Model\DataObject\Concrete::getHideUnpublished();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished(false);
	$currentData = \Pimcore\Model\DataObject\Service::useInheritedValues(false, function() {
		return $this->getLocalizedfields();
	});
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished($hideUnpublished);
	$this->markFieldDirty("localizedfields", true);
	$this->markFieldDirty("localizedfields", true);

	$this->localizedfields = $localizedfields;

	return $this;
}

/**
* Set name - Name
* @param string|null $name
* @return $this
*/
public function setName (?string $name, ?string $language = null): static
{
	$isEqual = false;
	$this->getLocalizedfields()->setLocalizedValue("name", $name, $language, !$isEqual);

	return $this;
}

/**
* Set productNamePart - Product Name Part
* @param string|null $productNamePart
* @return $this
*/
public function setProductNamePart (?string $productNamePart, ?string $language = null): static
{
	$isEqual = false;
	$this->getLocalizedfields()->setLocalizedValue("productNamePart", $productNamePart, $language, !$isEqual);

	return $this;
}

/**
* Get filterDefinition - Filter Definition
* @return \Pimcore\Model\DataObject\FilterDefinition|null
*/
public function getFilterDefinition(): ?\Pimcore\Model\Element\AbstractElement
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("filterDefinition");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->getClass()->getFieldDefinition("filterDefinition")->preGetData($this);

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("filterDefinition")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("filterDefinition");
		} catch (InheritanceParentNotFoundException $e) {
			// no data from parent available, continue ...
		}
	}

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set filterDefinition - Filter Definition
* @param \Pimcore\Model\DataObject\FilterDefinition|null $filterDefinition
* @return $this
*/
public function setFilterDefinition(?\Pimcore\Model\Element\AbstractElement $filterDefinition): static
{
	/** @var \Pimcore\Model\DataObject\ClassDefinition\Data\ManyToOneRelation $fd */
	$fd = $this->getClass()->getFieldDefinition("filterDefinition");
	$hideUnpublished = \Pimcore\Model\DataObject\Concrete::getHideUnpublished();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished(false);
	$currentData = \Pimcore\Model\DataObject\Service::useInheritedValues(false, function() {
		return $this->getFilterDefinition();
	});
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished($hideUnpublished);
	$isEqual = $fd->isEqual($currentData, $filterDefinition);
	if (!$isEqual) {
		$this->markFieldDirty("filterDefinition", true);
	}
	$this->filterDefinition = $fd->preSetData($this, $filterDefinition);
	return $this;
}

/**
* Get cars - Cars
* @return \App\Model\Product\Car[]
*/
public function getCars(): array
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("cars");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->getClass()->getFieldDefinition("cars")->preGetData($this);

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

}

