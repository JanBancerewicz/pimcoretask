<?php

/**
 * Inheritance: no
 * Variants: no
 *
 * Fields Summary:
 * - localizedfields [localizedfields]
 * -- title [input]
 * -- shortText [textarea]
 * - content [fieldcollections]
 * - date [datetime]
 * - gallery [imageGallery]
 */

namespace Pimcore\Model\DataObject;

use Pimcore\Model\DataObject\Exception\InheritanceParentNotFoundException;
use Pimcore\Model\DataObject\PreGetValueHookInterface;

/**
* @method static \Pimcore\Model\DataObject\News\Listing getList(array $config = [])
* @method static \Pimcore\Model\DataObject\News\Listing|\Pimcore\Model\DataObject\News|null getByLocalizedfields(string $field, mixed $value, ?string $locale = null, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\News\Listing|\Pimcore\Model\DataObject\News|null getByTitle(mixed $value, ?string $locale = null, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\News\Listing|\Pimcore\Model\DataObject\News|null getByShortText(mixed $value, ?string $locale = null, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\News\Listing|\Pimcore\Model\DataObject\News|null getByDate(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
*/

class News extends Concrete
{
public const FIELD_TITLE = 'title';
public const FIELD_SHORT_TEXT = 'shortText';
public const FIELD_CONTENT = 'content';
public const FIELD_DATE = 'date';
public const FIELD_GALLERY = 'gallery';

protected $classId = "NE";
protected $className = "News";
protected $localizedfields;
protected $content;
protected $date;
protected $gallery;


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
* Get localizedfields - 
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

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Get title - Title
* @return string|null
*/
public function getTitle(?string $language = null): ?string
{
	$data = $this->getLocalizedfields()->getLocalizedValue("title", $language);
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("title");
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
* Get shortText - Short Text
* @return string|null
*/
public function getShortText(?string $language = null): ?string
{
	$data = $this->getLocalizedfields()->getLocalizedValue("shortText", $language);
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("shortText");
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
* Set localizedfields - 
* @param \Pimcore\Model\DataObject\Localizedfield|null $localizedfields
* @return $this
*/
public function setLocalizedfields(?\Pimcore\Model\DataObject\Localizedfield $localizedfields): static
{
	$hideUnpublished = \Pimcore\Model\DataObject\Concrete::getHideUnpublished();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished(false);
	$currentData = $this->getLocalizedfields();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished($hideUnpublished);
	$this->markFieldDirty("localizedfields", true);
	$this->markFieldDirty("localizedfields", true);

	$this->localizedfields = $localizedfields;

	return $this;
}

/**
* Set title - Title
* @param string|null $title
* @return $this
*/
public function setTitle (?string $title, ?string $language = null): static
{
	$isEqual = false;
	$this->getLocalizedfields()->setLocalizedValue("title", $title, $language, !$isEqual);

	return $this;
}

/**
* Set shortText - Short Text
* @param string|null $shortText
* @return $this
*/
public function setShortText (?string $shortText, ?string $language = null): static
{
	$isEqual = false;
	$this->getLocalizedfields()->setLocalizedValue("shortText", $shortText, $language, !$isEqual);

	return $this;
}

/**
* @return \Pimcore\Model\DataObject\Fieldcollection|null
*/
public function getContent(): ?\Pimcore\Model\DataObject\Fieldcollection
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("content");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->getClass()->getFieldDefinition("content")->preGetData($this);
	return $data;
}

/**
* Set content - Content
* @param \Pimcore\Model\DataObject\Fieldcollection|null $content
* @return $this
*/
public function setContent(?\Pimcore\Model\DataObject\Fieldcollection $content): static
{
	/** @var \Pimcore\Model\DataObject\ClassDefinition\Data\Fieldcollections $fd */
	$fd = $this->getClass()->getFieldDefinition("content");
	$this->content = $fd->preSetData($this, $content);
	return $this;
}

/**
* Get date - Date
* @return \Carbon\Carbon|null
*/
public function getDate(): ?\Carbon\Carbon
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("date");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->date;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set date - Date
* @param \Carbon\Carbon|null $date
* @return $this
*/
public function setDate(?\Carbon\Carbon $date): static
{
	$this->markFieldDirty("date", true);

	$this->date = $date;

	return $this;
}

/**
* Get gallery - Gallery
* @return \Pimcore\Model\DataObject\Data\ImageGallery|null
*/
public function getGallery(): ?\Pimcore\Model\DataObject\Data\ImageGallery
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("gallery");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->gallery;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set gallery - Gallery
* @param \Pimcore\Model\DataObject\Data\ImageGallery|null $gallery
* @return $this
*/
public function setGallery(?\Pimcore\Model\DataObject\Data\ImageGallery $gallery): static
{
	$this->markFieldDirty("gallery", true);

	$this->gallery = $gallery;

	return $this;
}

}

