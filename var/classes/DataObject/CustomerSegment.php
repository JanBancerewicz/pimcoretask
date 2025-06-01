<?php

/**
 * Inheritance: no
 * Variants: no
 *
 * Fields Summary:
 * - name [input]
 * - group [manyToOneRelation]
 * - reference [input]
 * - calculated [checkbox]
 * - useAsTargetGroup [checkbox]
 * - targetGroup [targetGroup]
 */

namespace Pimcore\Model\DataObject;

use Pimcore\Model\DataObject\Exception\InheritanceParentNotFoundException;
use Pimcore\Model\DataObject\PreGetValueHookInterface;

/**
* @method static \Pimcore\Model\DataObject\CustomerSegment\Listing getList(array $config = [])
* @method static \Pimcore\Model\DataObject\CustomerSegment\Listing|\Pimcore\Model\DataObject\CustomerSegment|null getByName(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\CustomerSegment\Listing|\Pimcore\Model\DataObject\CustomerSegment|null getByGroup(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\CustomerSegment\Listing|\Pimcore\Model\DataObject\CustomerSegment|null getByReference(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\CustomerSegment\Listing|\Pimcore\Model\DataObject\CustomerSegment|null getByCalculated(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\CustomerSegment\Listing|\Pimcore\Model\DataObject\CustomerSegment|null getByUseAsTargetGroup(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\CustomerSegment\Listing|\Pimcore\Model\DataObject\CustomerSegment|null getByTargetGroup(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
*/

class CustomerSegment extends \CustomerManagementFrameworkBundle\Model\AbstractCustomerSegment
{
public const FIELD_NAME = 'name';
public const FIELD_GROUP = 'group';
public const FIELD_REFERENCE = 'reference';
public const FIELD_CALCULATED = 'calculated';
public const FIELD_USE_AS_TARGET_GROUP = 'useAsTargetGroup';
public const FIELD_TARGET_GROUP = 'targetGroup';

protected $classId = "2";
protected $className = "CustomerSegment";
protected $name;
protected $group;
protected $reference;
protected $calculated;
protected $useAsTargetGroup;
protected $targetGroup;


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
* Get name - Segment name
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
* Set name - Segment name
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
* Get group - Group
* @return \Pimcore\Model\DataObject\AbstractObject|null
*/
public function getGroup(): ?\Pimcore\Model\Element\AbstractElement
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("group");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->getClass()->getFieldDefinition("group")->preGetData($this);

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set group - Group
* @param \Pimcore\Model\DataObject\AbstractObject|null $group
* @return $this
*/
public function setGroup(?\Pimcore\Model\Element\AbstractElement $group): static
{
	/** @var \Pimcore\Model\DataObject\ClassDefinition\Data\ManyToOneRelation $fd */
	$fd = $this->getClass()->getFieldDefinition("group");
	$hideUnpublished = \Pimcore\Model\DataObject\Concrete::getHideUnpublished();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished(false);
	$currentData = $this->getGroup();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished($hideUnpublished);
	$isEqual = $fd->isEqual($currentData, $group);
	if (!$isEqual) {
		$this->markFieldDirty("group", true);
	}
	$this->group = $fd->preSetData($this, $group);
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
* Get useAsTargetGroup - Use As Target Group
* @return bool|null
*/
public function getUseAsTargetGroup(): ?bool
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("useAsTargetGroup");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->useAsTargetGroup;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set useAsTargetGroup - Use As Target Group
* @param bool|null $useAsTargetGroup
* @return $this
*/
public function setUseAsTargetGroup(?bool $useAsTargetGroup): static
{
	$this->markFieldDirty("useAsTargetGroup", true);

	$this->useAsTargetGroup = $useAsTargetGroup;

	return $this;
}

/**
* Get targetGroup - Linked TargetGroup
* @return string|null
*/
public function getTargetGroup(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("targetGroup");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->targetGroup;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set targetGroup - Linked TargetGroup
* @param string|null $targetGroup
* @return $this
*/
public function setTargetGroup(?string $targetGroup): static
{
	$this->markFieldDirty("targetGroup", true);

	$this->targetGroup = $targetGroup;

	return $this;
}

}

