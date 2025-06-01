<?php

/**
 * Inheritance: no
 * Variants: no
 *
 * Fields Summary:
 * - name [input]
 * - terms [block]
 * -- term [input]
 * -- phrases [table]
 */

namespace Pimcore\Model\DataObject;

use Pimcore\Model\DataObject\Exception\InheritanceParentNotFoundException;
use Pimcore\Model\DataObject\PreGetValueHookInterface;

/**
* @method static \Pimcore\Model\DataObject\TermSegmentBuilderDefinition\Listing getList(array $config = [])
* @method static \Pimcore\Model\DataObject\TermSegmentBuilderDefinition\Listing|\Pimcore\Model\DataObject\TermSegmentBuilderDefinition|null getByName(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
*/

class TermSegmentBuilderDefinition extends \CustomerManagementFrameworkBundle\Model\AbstractTermSegmentBuilderDefinition
{
public const FIELD_NAME = 'name';
public const FIELD_TERMS = 'terms';

protected $classId = "4";
protected $className = "TermSegmentBuilderDefinition";
protected $name;
protected $terms;


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
* Get name - Name
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
* Set name - Name
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
* Get terms - Terms
* @return \Pimcore\Model\DataObject\Data\BlockElement[][]
*/
public function getTerms(): ?array
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("terms");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->getClass()->getFieldDefinition("terms")->preGetData($this);

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set terms - Terms
* @param \Pimcore\Model\DataObject\Data\BlockElement[][] $terms
* @return $this
*/
public function setTerms(?array $terms): static
{
	/** @var \Pimcore\Model\DataObject\ClassDefinition\Data\Block $fd */
	$fd = $this->getClass()->getFieldDefinition("terms");
	$this->terms = $fd->preSetData($this, $terms);
	return $this;
}

}

