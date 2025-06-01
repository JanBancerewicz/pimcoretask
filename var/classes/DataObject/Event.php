<?php

/**
 * Inheritance: no
 * Variants: no
 *
 * Fields Summary:
 * - localizedfields [localizedfields]
 * -- title [input]
 * -- description [wysiwyg]
 * - tags [multiselect]
 * - locationAddress [textarea]
 * - locationMap [geopoint]
 * - status [select]
 * - fromDate [datetime]
 * - toDate [datetime]
 * - cars [manyToManyObjectRelation]
 * - mainImage [image]
 * - video [video]
 * - images [imageGallery]
 * - contactName [input]
 * - contactPhone [input]
 * - contactEmail [input]
 * - contactAddress [textarea]
 */

namespace Pimcore\Model\DataObject;

use Pimcore\Model\DataObject\Exception\InheritanceParentNotFoundException;
use Pimcore\Model\DataObject\PreGetValueHookInterface;

/**
* @method static \Pimcore\Model\DataObject\Event\Listing getList(array $config = [])
* @method static \Pimcore\Model\DataObject\Event\Listing|\Pimcore\Model\DataObject\Event|null getByLocalizedfields(string $field, mixed $value, ?string $locale = null, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Event\Listing|\Pimcore\Model\DataObject\Event|null getByTitle(mixed $value, ?string $locale = null, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Event\Listing|\Pimcore\Model\DataObject\Event|null getByDescription(mixed $value, ?string $locale = null, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Event\Listing|\Pimcore\Model\DataObject\Event|null getByTags(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Event\Listing|\Pimcore\Model\DataObject\Event|null getByLocationAddress(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Event\Listing|\Pimcore\Model\DataObject\Event|null getByStatus(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Event\Listing|\Pimcore\Model\DataObject\Event|null getByFromDate(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Event\Listing|\Pimcore\Model\DataObject\Event|null getByToDate(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Event\Listing|\Pimcore\Model\DataObject\Event|null getByCars(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Event\Listing|\Pimcore\Model\DataObject\Event|null getByMainImage(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Event\Listing|\Pimcore\Model\DataObject\Event|null getByContactName(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Event\Listing|\Pimcore\Model\DataObject\Event|null getByContactPhone(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Event\Listing|\Pimcore\Model\DataObject\Event|null getByContactEmail(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Event\Listing|\Pimcore\Model\DataObject\Event|null getByContactAddress(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
*/

class Event extends Concrete
{
public const FIELD_TITLE = 'title';
public const FIELD_DESCRIPTION = 'description';
public const FIELD_TAGS = 'tags';
public const FIELD_LOCATION_ADDRESS = 'locationAddress';
public const FIELD_LOCATION_MAP = 'locationMap';
public const FIELD_STATUS = 'status';
public const FIELD_FROM_DATE = 'fromDate';
public const FIELD_TO_DATE = 'toDate';
public const FIELD_CARS = 'cars';
public const FIELD_MAIN_IMAGE = 'mainImage';
public const FIELD_VIDEO = 'video';
public const FIELD_IMAGES = 'images';
public const FIELD_CONTACT_NAME = 'contactName';
public const FIELD_CONTACT_PHONE = 'contactPhone';
public const FIELD_CONTACT_EMAIL = 'contactEmail';
public const FIELD_CONTACT_ADDRESS = 'contactAddress';

protected $classId = "EV";
protected $className = "Event";
protected $localizedfields;
protected $tags;
protected $locationAddress;
protected $locationMap;
protected $status;
protected $fromDate;
protected $toDate;
protected $cars;
protected $mainImage;
protected $video;
protected $images;
protected $contactName;
protected $contactPhone;
protected $contactEmail;
protected $contactAddress;


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
* Get title - title
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
* Get description - Description
* @return string|null
*/
public function getDescription(?string $language = null): ?string
{
	$data = $this->getLocalizedfields()->getLocalizedValue("description", $language);
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("description");
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
* Set title - title
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
* Set description - Description
* @param string|null $description
* @return $this
*/
public function setDescription (?string $description, ?string $language = null): static
{
	$isEqual = false;
	$this->getLocalizedfields()->setLocalizedValue("description", $description, $language, !$isEqual);

	return $this;
}

/**
* Get tags - Tags
* @return string[]|null
*/
public function getTags(): ?array
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("tags");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->tags;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set tags - Tags
* @param string[]|null $tags
* @return $this
*/
public function setTags(?array $tags): static
{
	$this->markFieldDirty("tags", true);

	$this->tags = $tags;

	return $this;
}

/**
* Get locationAddress - Location Address
* @return string|null
*/
public function getLocationAddress(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("locationAddress");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->locationAddress;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set locationAddress - Location Address
* @param string|null $locationAddress
* @return $this
*/
public function setLocationAddress(?string $locationAddress): static
{
	$this->markFieldDirty("locationAddress", true);

	$this->locationAddress = $locationAddress;

	return $this;
}

/**
* Get locationMap - Location Map
* @return \Pimcore\Model\DataObject\Data\GeoCoordinates|null
*/
public function getLocationMap(): ?\Pimcore\Model\DataObject\Data\GeoCoordinates
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("locationMap");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->locationMap;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set locationMap - Location Map
* @param \Pimcore\Model\DataObject\Data\GeoCoordinates|null $locationMap
* @return $this
*/
public function setLocationMap(?\Pimcore\Model\DataObject\Data\GeoCoordinates $locationMap): static
{
	$this->markFieldDirty("locationMap", true);

	$this->locationMap = $locationMap;

	return $this;
}

/**
* Get status - Status
* @return string|null
*/
public function getStatus(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("status");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->status;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set status - Status
* @param string|null $status
* @return $this
*/
public function setStatus(?string $status): static
{
	$this->markFieldDirty("status", true);

	$this->status = $status;

	return $this;
}

/**
* Get fromDate - Start
* @return \Carbon\Carbon|null
*/
public function getFromDate(): ?\Carbon\Carbon
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("fromDate");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->fromDate;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set fromDate - Start
* @param \Carbon\Carbon|null $fromDate
* @return $this
*/
public function setFromDate(?\Carbon\Carbon $fromDate): static
{
	$this->markFieldDirty("fromDate", true);

	$this->fromDate = $fromDate;

	return $this;
}

/**
* Get toDate - End
* @return \Carbon\Carbon|null
*/
public function getToDate(): ?\Carbon\Carbon
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("toDate");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->toDate;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set toDate - End
* @param \Carbon\Carbon|null $toDate
* @return $this
*/
public function setToDate(?\Carbon\Carbon $toDate): static
{
	$this->markFieldDirty("toDate", true);

	$this->toDate = $toDate;

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

/**
* Set cars - Cars
* @param \App\Model\Product\Car[] $cars
* @return $this
*/
public function setCars(?array $cars): static
{
	/** @var \Pimcore\Model\DataObject\ClassDefinition\Data\ManyToManyObjectRelation $fd */
	$fd = $this->getClass()->getFieldDefinition("cars");
	$hideUnpublished = \Pimcore\Model\DataObject\Concrete::getHideUnpublished();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished(false);
	$currentData = $this->getCars();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished($hideUnpublished);
	$isEqual = $fd->isEqual($currentData, $cars);
	if (!$isEqual) {
		$this->markFieldDirty("cars", true);
	}
	$this->cars = $fd->preSetData($this, $cars);
	return $this;
}

/**
* Get mainImage - Image
* @return \Pimcore\Model\Asset\Image|null
*/
public function getMainImage(): ?\Pimcore\Model\Asset\Image
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("mainImage");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->mainImage;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set mainImage - Image
* @param \Pimcore\Model\Asset\Image|null $mainImage
* @return $this
*/
public function setMainImage(?\Pimcore\Model\Asset\Image $mainImage): static
{
	$this->markFieldDirty("mainImage", true);

	$this->mainImage = $mainImage;

	return $this;
}

/**
* Get video - Video
* @return \Pimcore\Model\DataObject\Data\Video|null
*/
public function getVideo(): ?\Pimcore\Model\DataObject\Data\Video
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("video");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->video;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set video - Video
* @param \Pimcore\Model\DataObject\Data\Video|null $video
* @return $this
*/
public function setVideo(?\Pimcore\Model\DataObject\Data\Video $video): static
{
	$this->markFieldDirty("video", true);

	$this->video = $video;

	return $this;
}

/**
* Get images - Additional Images
* @return \Pimcore\Model\DataObject\Data\ImageGallery|null
*/
public function getImages(): ?\Pimcore\Model\DataObject\Data\ImageGallery
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("images");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->images;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set images - Additional Images
* @param \Pimcore\Model\DataObject\Data\ImageGallery|null $images
* @return $this
*/
public function setImages(?\Pimcore\Model\DataObject\Data\ImageGallery $images): static
{
	$this->markFieldDirty("images", true);

	$this->images = $images;

	return $this;
}

/**
* Get contactName - Name
* @return string|null
*/
public function getContactName(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("contactName");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->contactName;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set contactName - Name
* @param string|null $contactName
* @return $this
*/
public function setContactName(?string $contactName): static
{
	$this->markFieldDirty("contactName", true);

	$this->contactName = $contactName;

	return $this;
}

/**
* Get contactPhone - Phone
* @return string|null
*/
public function getContactPhone(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("contactPhone");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->contactPhone;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set contactPhone - Phone
* @param string|null $contactPhone
* @return $this
*/
public function setContactPhone(?string $contactPhone): static
{
	$this->markFieldDirty("contactPhone", true);

	$this->contactPhone = $contactPhone;

	return $this;
}

/**
* Get contactEmail - Email
* @return string|null
*/
public function getContactEmail(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("contactEmail");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->contactEmail;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set contactEmail - Email
* @param string|null $contactEmail
* @return $this
*/
public function setContactEmail(?string $contactEmail): static
{
	$this->markFieldDirty("contactEmail", true);

	$this->contactEmail = $contactEmail;

	return $this;
}

/**
* Get contactAddress - Address
* @return string|null
*/
public function getContactAddress(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("contactAddress");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->contactAddress;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set contactAddress - Address
* @param string|null $contactAddress
* @return $this
*/
public function setContactAddress(?string $contactAddress): static
{
	$this->markFieldDirty("contactAddress", true);

	$this->contactAddress = $contactAddress;

	return $this;
}

}

