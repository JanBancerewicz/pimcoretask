<?php

/**
 * Inheritance: no
 * Variants: no
 *
 * Fields Summary:
 * - name [input]
 * - reference [input]
 * - calculated [checkbox]
 * - showAsFilter [checkbox]
 * - filterSortOrder [numeric]
 * - exportNewsletterProvider [checkbox]
 */

namespace Pimcore\Model\DataObject;

use Pimcore\Model\DataObject\Exception\InheritanceParentNotFoundException;
use Pimcore\Model\DataObject\PreGetValueHookInterface;

/**
* @method static \Pimcore\Model\DataObject\CustomerSegmentGroup\Listing getList(array $config = [])
* @method static \Pimcore\Model\DataObject\CustomerSegmentGroup\Listing|\Pimcore\Model\DataObject\CustomerSegmentGroup|null getByName(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\CustomerSegmentGroup\Listing|\Pimcore\Model\DataObject\CustomerSegmentGroup|null getByReference(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\CustomerSegmentGroup\Listing|\Pimcore\Model\DataObject\CustomerSegmentGroup|null getByCalculated(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\CustomerSegmentGroup\Listing|\Pimcore\Model\DataObject\CustomerSegmentGroup|null getByShowAsFilter(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\CustomerSegmentGroup\Listing|\Pimcore\Model\DataObject\CustomerSegmentGroup|null getByFilterSortOrder(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\CustomerSegmentGroup\Listing|\Pimcore\Model\DataObject\CustomerSegmentGroup|null getByExportNewsletterProvider(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
*/

class CustomerSegmentGroup extends Concrete
{
public const FIELD_NAME = 'name';
public const FIELD_REFERENCE = 'reference';
public const FIELD_CALCULATED = 'calculated';
public const FIELD_SHOW_AS_FILTER = 'showAsFilter';
public const FIELD_FILTER_SORT_ORDER = 'filterSortOrder';
public const FIELD_EXPORT_NEWSLETTER_PROVIDER = 'exportNewsletterProvider';

protected $classId = "1";
protected $className = "CustomerSegmentGroup";
protected $name;
protected $reference;
protected $calculated;
protected $showAsFilter;
protected $filterSortOrder;
protected $exportNewsletterProvider;


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
* Get name - Segment group name
* @return string|null
*/
public function getName(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("name");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->name;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set name - Segment group name
* @param string|null $name
* @return $this
*/
public function setName(?string $name): static
{
	$this->markFieldDirty("name", true);

	$this->name = $name;

	return $this;
}

/**
* Get reference - Reference
* @return string|null
*/
public function getReference(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("reference");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->reference;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set reference - Reference
* @param string|null $reference
* @return $this
*/
public function setReference(?string $reference): static
{
	$this->markFieldDirty("reference", true);

	$this->reference = $reference;

	return $this;
}

/**
* Get calculated - calculated
* @return bool|null
*/
public function getCalculated(): ?bool
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("calculated");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->calculated;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set calculated - calculated
* @param bool|null $calculated
* @return $this
*/
public function setCalculated(?bool $calculated): static
{
	$this->markFieldDirty("calculated", true);

	$this->calculated = $calculated;

	return $this;
}

/**
* Get showAsFilter - Show as Filter
* @return bool|null
*/
public function getShowAsFilter(): ?bool
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("showAsFilter");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->showAsFilter;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set showAsFilter - Show as Filter
* @param bool|null $showAsFilter
* @return $this
*/
public function setShowAsFilter(?bool $showAsFilter): static
{
	$this->markFieldDirty("showAsFilter", true);

	$this->showAsFilter = $showAsFilter;

	return $this;
}

/**
* Get filterSortOrder - Filter sort order
* @return int|null
*/
public function getFilterSortOrder(): ?int
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("filterSortOrder");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->filterSortOrder;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set filterSortOrder - Filter sort order
* @param int|null $filterSortOrder
* @return $this
*/
public function setFilterSortOrder(?int $filterSortOrder): static
{
	/** @var \Pimcore\Model\DataObject\ClassDefinition\Data\Numeric $fd */
	$fd = $this->getClass()->getFieldDefinition("filterSortOrder");
	$this->filterSortOrder = $fd->preSetData($this, $filterSortOrder);
	return $this;
}

/**
* Get exportNewsletterProvider - Export to newsletter provider
* @return bool|null
*/
public function getExportNewsletterProvider(): ?bool
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("exportNewsletterProvider");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->exportNewsletterProvider;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set exportNewsletterProvider - Export to newsletter provider
* @param bool|null $exportNewsletterProvider
* @return $this
*/
public function setExportNewsletterProvider(?bool $exportNewsletterProvider): static
{
	$this->markFieldDirty("exportNewsletterProvider", true);

	$this->exportNewsletterProvider = $exportNewsletterProvider;

	return $this;
}

}

