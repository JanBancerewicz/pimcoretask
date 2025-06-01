<?php

/**
 * Inheritance: yes
 * Variants: no
 *
 * Fields Summary:
 * - code [input]
 * - attributeType [input]
 * - label [input]
 * - link [link]
 * - active [select]
 * - utm_source [input]
 * - utm_medium [input]
 * - utm_campaign [input]
 * - utm_term [input]
 * - utm_content [input]
 * - attributes [block]
 * -- attribute [input]
 * -- attributeValue [input]
 */

namespace Pimcore\Model\DataObject;

use Pimcore\Model\DataObject\Exception\InheritanceParentNotFoundException;
use Pimcore\Model\DataObject\PreGetValueHookInterface;

/**
* @method static \Pimcore\Model\DataObject\LinkActivityDefinition\Listing getList(array $config = [])
* @method static \Pimcore\Model\DataObject\LinkActivityDefinition\Listing|\Pimcore\Model\DataObject\LinkActivityDefinition|null getByCode(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\LinkActivityDefinition\Listing|\Pimcore\Model\DataObject\LinkActivityDefinition|null getByAttributeType(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\LinkActivityDefinition\Listing|\Pimcore\Model\DataObject\LinkActivityDefinition|null getByLabel(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\LinkActivityDefinition\Listing|\Pimcore\Model\DataObject\LinkActivityDefinition|null getByActive(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\LinkActivityDefinition\Listing|\Pimcore\Model\DataObject\LinkActivityDefinition|null getByUtm_source(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\LinkActivityDefinition\Listing|\Pimcore\Model\DataObject\LinkActivityDefinition|null getByUtm_medium(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\LinkActivityDefinition\Listing|\Pimcore\Model\DataObject\LinkActivityDefinition|null getByUtm_campaign(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\LinkActivityDefinition\Listing|\Pimcore\Model\DataObject\LinkActivityDefinition|null getByUtm_term(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\LinkActivityDefinition\Listing|\Pimcore\Model\DataObject\LinkActivityDefinition|null getByUtm_content(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
*/

class LinkActivityDefinition extends Concrete
{
public const FIELD_CODE = 'code';
public const FIELD_ATTRIBUTE_TYPE = 'attributeType';
public const FIELD_LABEL = 'label';
public const FIELD_LINK = 'link';
public const FIELD_ACTIVE = 'active';
public const FIELD_UTM_SOURCE = 'utm_source';
public const FIELD_UTM_MEDIUM = 'utm_medium';
public const FIELD_UTM_CAMPAIGN = 'utm_campaign';
public const FIELD_UTM_TERM = 'utm_term';
public const FIELD_UTM_CONTENT = 'utm_content';
public const FIELD_ATTRIBUTES = 'attributes';

protected $classId = "5";
protected $className = "LinkActivityDefinition";
protected $code;
protected $attributeType;
protected $label;
protected $link;
protected $active;
protected $utm_source;
protected $utm_medium;
protected $utm_campaign;
protected $utm_term;
protected $utm_content;
protected $attributes;


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
* Get code - code (cmfa)
* @return string|null
*/
public function getCode(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("code");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->code;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("code")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("code");
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
* Set code - code (cmfa)
* @param string|null $code
* @return $this
*/
public function setCode(?string $code): static
{
	$this->markFieldDirty("code", true);

	$this->code = $code;

	return $this;
}

/**
* Get attributeType - type
* @return string|null
*/
public function getAttributeType(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("attributeType");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->attributeType;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("attributeType")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("attributeType");
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
* Set attributeType - type
* @param string|null $attributeType
* @return $this
*/
public function setAttributeType(?string $attributeType): static
{
	$this->markFieldDirty("attributeType", true);

	$this->attributeType = $attributeType;

	return $this;
}

/**
* Get label - label
* @return string|null
*/
public function getLabel(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("label");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->label;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("label")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("label");
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
* Set label - label
* @param string|null $label
* @return $this
*/
public function setLabel(?string $label): static
{
	$this->markFieldDirty("label", true);

	$this->label = $label;

	return $this;
}

/**
* Get link - Landing page link
* @return \Pimcore\Model\DataObject\Data\Link|null
*/
public function getLink(): ?\Pimcore\Model\DataObject\Data\Link
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("link");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->link;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("link")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("link");
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
* Set link - Landing page link
* @param \Pimcore\Model\DataObject\Data\Link|null $link
* @return $this
*/
public function setLink(?\Pimcore\Model\DataObject\Data\Link $link): static
{
	$this->markFieldDirty("link", true);

	$this->link = $link;

	return $this;
}

/**
* Get active - active
* @return string|null
*/
public function getActive(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("active");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->active;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("active")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("active");
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
* Set active - active
* @param string|null $active
* @return $this
*/
public function setActive(?string $active): static
{
	$this->markFieldDirty("active", true);

	$this->active = $active;

	return $this;
}

/**
* Get utm_source - Campaign Source (utm_source)
* @return string|null
*/
public function getUtm_source(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("utm_source");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->utm_source;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("utm_source")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("utm_source");
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
* Set utm_source - Campaign Source (utm_source)
* @param string|null $utm_source
* @return $this
*/
public function setUtm_source(?string $utm_source): static
{
	$this->markFieldDirty("utm_source", true);

	$this->utm_source = $utm_source;

	return $this;
}

/**
* Get utm_medium - Campaign Medium (utm_medium)
* @return string|null
*/
public function getUtm_medium(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("utm_medium");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->utm_medium;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("utm_medium")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("utm_medium");
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
* Set utm_medium - Campaign Medium (utm_medium)
* @param string|null $utm_medium
* @return $this
*/
public function setUtm_medium(?string $utm_medium): static
{
	$this->markFieldDirty("utm_medium", true);

	$this->utm_medium = $utm_medium;

	return $this;
}

/**
* Get utm_campaign - Campaign Name (utm_campaign)
* @return string|null
*/
public function getUtm_campaign(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("utm_campaign");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->utm_campaign;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("utm_campaign")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("utm_campaign");
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
* Set utm_campaign - Campaign Name (utm_campaign)
* @param string|null $utm_campaign
* @return $this
*/
public function setUtm_campaign(?string $utm_campaign): static
{
	$this->markFieldDirty("utm_campaign", true);

	$this->utm_campaign = $utm_campaign;

	return $this;
}

/**
* Get utm_term - Campaign Term (utm_term)
* @return string|null
*/
public function getUtm_term(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("utm_term");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->utm_term;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("utm_term")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("utm_term");
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
* Set utm_term - Campaign Term (utm_term)
* @param string|null $utm_term
* @return $this
*/
public function setUtm_term(?string $utm_term): static
{
	$this->markFieldDirty("utm_term", true);

	$this->utm_term = $utm_term;

	return $this;
}

/**
* Get utm_content - Campaign Content (utm_content)
* @return string|null
*/
public function getUtm_content(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("utm_content");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->utm_content;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("utm_content")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("utm_content");
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
* Set utm_content - Campaign Content (utm_content)
* @param string|null $utm_content
* @return $this
*/
public function setUtm_content(?string $utm_content): static
{
	$this->markFieldDirty("utm_content", true);

	$this->utm_content = $utm_content;

	return $this;
}

/**
* Get attributes - Additional attributes
* @return \Pimcore\Model\DataObject\Data\BlockElement[][]
*/
public function getAttributes(): ?array
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("attributes");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->getClass()->getFieldDefinition("attributes")->preGetData($this);

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("attributes")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("attributes");
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
* Set attributes - Additional attributes
* @param \Pimcore\Model\DataObject\Data\BlockElement[][] $attributes
* @return $this
*/
public function setAttributes(?array $attributes): static
{
	/** @var \Pimcore\Model\DataObject\ClassDefinition\Data\Block $fd */
	$fd = $this->getClass()->getFieldDefinition("attributes");
	$this->attributes = $fd->preSetData($this, $attributes);
	return $this;
}

}

