<?php

/**
 * Inheritance: yes
 * Variants: no
 *
 * Fields Summary:
 * - localizedfields [localizedfields]
 * -- name [input]
 * -- description [wysiwyg]
 * -- textsAvailable [calculatedValue]
 * - series [input]
 * - manufacturer [manyToOneRelation]
 * - bodyStyle [manyToOneRelation]
 * - carClass [select]
 * - productionYear [numeric]
 * - color [multiselect]
 * - country [country]
 * - categories [manyToManyObjectRelation]
 * - gallery [imageGallery]
 * - genericImages [imageGallery]
 * - attributes [objectbricks]
 * - saleInformation [objectbricks]
 * - location [geopoint]
 * - attributesAvailable [calculatedValue]
 * - saleInformationAvailable [calculatedValue]
 * - imagesAvailable [calculatedValue]
 * - objectType [select]
 * - urlSlug [urlSlug]
 */

namespace Pimcore\Model\DataObject;

use Pimcore\Model\DataObject\Exception\InheritanceParentNotFoundException;
use Pimcore\Model\DataObject\PreGetValueHookInterface;

/**
* @method static \Pimcore\Model\DataObject\Car\Listing getList(array $config = [])
* @method static \Pimcore\Model\DataObject\Car\Listing|\Pimcore\Model\DataObject\Car|null getByLocalizedfields(string $field, mixed $value, ?string $locale = null, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Car\Listing|\Pimcore\Model\DataObject\Car|null getByName(mixed $value, ?string $locale = null, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Car\Listing|\Pimcore\Model\DataObject\Car|null getByDescription(mixed $value, ?string $locale = null, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Car\Listing|\Pimcore\Model\DataObject\Car|null getByTextsAvailable(mixed $value, ?string $locale = null, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Car\Listing|\Pimcore\Model\DataObject\Car|null getBySeries(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Car\Listing|\Pimcore\Model\DataObject\Car|null getByManufacturer(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Car\Listing|\Pimcore\Model\DataObject\Car|null getByBodyStyle(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Car\Listing|\Pimcore\Model\DataObject\Car|null getByCarClass(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Car\Listing|\Pimcore\Model\DataObject\Car|null getByProductionYear(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Car\Listing|\Pimcore\Model\DataObject\Car|null getByColor(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Car\Listing|\Pimcore\Model\DataObject\Car|null getByCountry(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Car\Listing|\Pimcore\Model\DataObject\Car|null getByCategories(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Car\Listing|\Pimcore\Model\DataObject\Car|null getByObjectType(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Car\Listing|\Pimcore\Model\DataObject\Car|null getByUrlSlug(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
*/

class Car extends \App\Model\Product\AbstractProduct
{
public const FIELD_NAME = 'name';
public const FIELD_DESCRIPTION = 'description';
public const FIELD_TEXTS_AVAILABLE = 'textsAvailable';
public const FIELD_SERIES = 'series';
public const FIELD_MANUFACTURER = 'manufacturer';
public const FIELD_BODY_STYLE = 'bodyStyle';
public const FIELD_CAR_CLASS = 'carClass';
public const FIELD_PRODUCTION_YEAR = 'productionYear';
public const FIELD_COLOR = 'color';
public const FIELD_COUNTRY = 'country';
public const FIELD_CATEGORIES = 'categories';
public const FIELD_GALLERY = 'gallery';
public const FIELD_GENERIC_IMAGES = 'genericImages';
public const FIELD_ATTRIBUTES = 'attributes';
public const FIELD_SALE_INFORMATION = 'saleInformation';
public const FIELD_LOCATION = 'location';
public const FIELD_ATTRIBUTES_AVAILABLE = 'attributesAvailable';
public const FIELD_SALE_INFORMATION_AVAILABLE = 'saleInformationAvailable';
public const FIELD_IMAGES_AVAILABLE = 'imagesAvailable';
public const FIELD_OBJECT_TYPE = 'objectType';
public const FIELD_URL_SLUG = 'urlSlug';

protected $classId = "CAR";
protected $className = "Car";
protected $localizedfields;
protected $series;
protected $manufacturer;
protected $bodyStyle;
protected $carClass;
protected $productionYear;
protected $color;
protected $country;
protected $categories;
protected $gallery;
protected $genericImages;
protected $attributes;
protected $saleInformation;
protected $location;
protected $objectType;
protected $urlSlug;


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
* Get textsAvailable - Texts Available
* @return mixed
*/
public function getTextsAvailable(?string $language = null): mixed
{
	if (!$language) {
		try {
			$locale = \Pimcore::getContainer()->get("Pimcore\Localization\LocaleServiceInterface")->getLocale();
			if (\Pimcore\Tool::isValidLanguage($locale)) {
				$language = (string) $locale;
			} else {
				throw new \Exception("Not supported language");
			}
		} catch (\Exception $e) {
			$language = \Pimcore\Tool::getDefaultLanguage();
		}
	}
	$object = $this;
	$fieldDefinition = $this->getClass()->getFieldDefinition("localizedfields")->getFieldDefinition("textsAvailable");
	$data = new \Pimcore\Model\DataObject\Data\CalculatedValue('textsAvailable');
	$data->setContextualData("localizedfield", "localizedfields", null, $language, null, null, $fieldDefinition);
	$data = \Pimcore\Model\DataObject\Service::getCalculatedFieldValue($object, $data);
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
* Get series - Series
* @return string|null
*/
public function getSeries(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("series");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->series;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("series")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("series");
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
* Set series - Series
* @param string|null $series
* @return $this
*/
public function setSeries(?string $series): static
{
	$this->markFieldDirty("series", true);

	$this->series = $series;

	return $this;
}

/**
* Get manufacturer - Manufacturer
* @return \Pimcore\Model\DataObject\Manufacturer|null
*/
public function getManufacturer(): ?\Pimcore\Model\Element\AbstractElement
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("manufacturer");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->getClass()->getFieldDefinition("manufacturer")->preGetData($this);

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("manufacturer")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("manufacturer");
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
* Set manufacturer - Manufacturer
* @param \Pimcore\Model\DataObject\Manufacturer|null $manufacturer
* @return $this
*/
public function setManufacturer(?\Pimcore\Model\Element\AbstractElement $manufacturer): static
{
	/** @var \Pimcore\Model\DataObject\ClassDefinition\Data\ManyToOneRelation $fd */
	$fd = $this->getClass()->getFieldDefinition("manufacturer");
	$hideUnpublished = \Pimcore\Model\DataObject\Concrete::getHideUnpublished();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished(false);
	$currentData = \Pimcore\Model\DataObject\Service::useInheritedValues(false, function() {
		return $this->getManufacturer();
	});
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished($hideUnpublished);
	$isEqual = $fd->isEqual($currentData, $manufacturer);
	if (!$isEqual) {
		$this->markFieldDirty("manufacturer", true);
	}
	$this->manufacturer = $fd->preSetData($this, $manufacturer);
	return $this;
}

/**
* Get bodyStyle - Body Style
* @return \Pimcore\Model\DataObject\BodyStyle|null
*/
public function getBodyStyle(): ?\Pimcore\Model\Element\AbstractElement
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("bodyStyle");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->getClass()->getFieldDefinition("bodyStyle")->preGetData($this);

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("bodyStyle")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("bodyStyle");
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
* Set bodyStyle - Body Style
* @param \Pimcore\Model\DataObject\BodyStyle|null $bodyStyle
* @return $this
*/
public function setBodyStyle(?\Pimcore\Model\Element\AbstractElement $bodyStyle): static
{
	/** @var \Pimcore\Model\DataObject\ClassDefinition\Data\ManyToOneRelation $fd */
	$fd = $this->getClass()->getFieldDefinition("bodyStyle");
	$hideUnpublished = \Pimcore\Model\DataObject\Concrete::getHideUnpublished();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished(false);
	$currentData = \Pimcore\Model\DataObject\Service::useInheritedValues(false, function() {
		return $this->getBodyStyle();
	});
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished($hideUnpublished);
	$isEqual = $fd->isEqual($currentData, $bodyStyle);
	if (!$isEqual) {
		$this->markFieldDirty("bodyStyle", true);
	}
	$this->bodyStyle = $fd->preSetData($this, $bodyStyle);
	return $this;
}

/**
* Get carClass - Class
* @return string|null
*/
public function getCarClass(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("carClass");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->carClass;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("carClass")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("carClass");
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
* Set carClass - Class
* @param string|null $carClass
* @return $this
*/
public function setCarClass(?string $carClass): static
{
	$this->markFieldDirty("carClass", true);

	$this->carClass = $carClass;

	return $this;
}

/**
* Get productionYear - Production Year
* @return int|null
*/
public function getProductionYear(): ?int
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("productionYear");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->productionYear;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("productionYear")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("productionYear");
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
* Set productionYear - Production Year
* @param int|null $productionYear
* @return $this
*/
public function setProductionYear(?int $productionYear): static
{
	/** @var \Pimcore\Model\DataObject\ClassDefinition\Data\Numeric $fd */
	$fd = $this->getClass()->getFieldDefinition("productionYear");
	$this->productionYear = $fd->preSetData($this, $productionYear);
	return $this;
}

/**
* Get color - Color
* @return string[]|null
*/
public function getColor(): ?array
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("color");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->color;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("color")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("color");
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
* Set color - Color
* @param string[]|null $color
* @return $this
*/
public function setColor(?array $color): static
{
	$this->markFieldDirty("color", true);

	$this->color = $color;

	return $this;
}

/**
* Get country - Country
* @return string|null
*/
public function getCountry(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("country");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->country;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("country")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("country");
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
* Set country - Country
* @param string|null $country
* @return $this
*/
public function setCountry(?string $country): static
{
	$this->markFieldDirty("country", true);

	$this->country = $country;

	return $this;
}

/**
* Get categories - Categories
* @return \App\Model\Product\Category[]
*/
public function getCategories(): array
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("categories");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->getClass()->getFieldDefinition("categories")->preGetData($this);

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("categories")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("categories");
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
* Set categories - Categories
* @param \App\Model\Product\Category[] $categories
* @return $this
*/
public function setCategories(?array $categories): static
{
	/** @var \Pimcore\Model\DataObject\ClassDefinition\Data\ManyToManyObjectRelation $fd */
	$fd = $this->getClass()->getFieldDefinition("categories");
	$hideUnpublished = \Pimcore\Model\DataObject\Concrete::getHideUnpublished();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished(false);
	$currentData = \Pimcore\Model\DataObject\Service::useInheritedValues(false, function() {
		return $this->getCategories();
	});
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished($hideUnpublished);
	$isEqual = $fd->isEqual($currentData, $categories);
	if (!$isEqual) {
		$this->markFieldDirty("categories", true);
	}
	$this->categories = $fd->preSetData($this, $categories);
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

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("gallery")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("gallery");
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

/**
* Get genericImages - Generic Images
* @return \Pimcore\Model\DataObject\Data\ImageGallery|null
*/
public function getGenericImages(): ?\Pimcore\Model\DataObject\Data\ImageGallery
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("genericImages");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->genericImages;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("genericImages")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("genericImages");
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
* Set genericImages - Generic Images
* @param \Pimcore\Model\DataObject\Data\ImageGallery|null $genericImages
* @return $this
*/
public function setGenericImages(?\Pimcore\Model\DataObject\Data\ImageGallery $genericImages): static
{
	$this->markFieldDirty("genericImages", true);

	$this->genericImages = $genericImages;

	return $this;
}

/**
* @return \Pimcore\Model\DataObject\Car\Attributes
*/
public function getAttributes(): ?\Pimcore\Model\DataObject\Objectbrick
{
	$data = $this->attributes;
	if (!$data) {
		if (\Pimcore\Tool::classExists("\\Pimcore\\Model\\DataObject\\Car\\Attributes")) {
			$data = new \Pimcore\Model\DataObject\Car\Attributes($this, "attributes");
			$this->attributes = $data;
		} else {
			return null;
		}
	}
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("attributes");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	return $data;
}

/**
* Set attributes - Attributes
* @param \Pimcore\Model\DataObject\Objectbrick|null $attributes
* @return $this
*/
public function setAttributes(?\Pimcore\Model\DataObject\Objectbrick $attributes): static
{
	/** @var \Pimcore\Model\DataObject\ClassDefinition\Data\Objectbricks $fd */
	$fd = $this->getClass()->getFieldDefinition("attributes");
	$this->attributes = $fd->preSetData($this, $attributes);
	return $this;
}

/**
* @return \Pimcore\Model\DataObject\Car\SaleInformation
*/
public function getSaleInformation(): ?\Pimcore\Model\DataObject\Objectbrick
{
	$data = $this->saleInformation;
	if (!$data) {
		if (\Pimcore\Tool::classExists("\\Pimcore\\Model\\DataObject\\Car\\SaleInformation")) {
			$data = new \Pimcore\Model\DataObject\Car\SaleInformation($this, "saleInformation");
			$this->saleInformation = $data;
		} else {
			return null;
		}
	}
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("saleInformation");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	return $data;
}

/**
* Set saleInformation - Sale Information
* @param \Pimcore\Model\DataObject\Objectbrick|null $saleInformation
* @return $this
*/
public function setSaleInformation(?\Pimcore\Model\DataObject\Objectbrick $saleInformation): static
{
	/** @var \Pimcore\Model\DataObject\ClassDefinition\Data\Objectbricks $fd */
	$fd = $this->getClass()->getFieldDefinition("saleInformation");
	$this->saleInformation = $fd->preSetData($this, $saleInformation);
	return $this;
}

/**
* Get location - Location
* @return \Pimcore\Model\DataObject\Data\GeoCoordinates|null
*/
public function getLocation(): ?\Pimcore\Model\DataObject\Data\GeoCoordinates
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("location");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->location;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("location")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("location");
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
* Set location - Location
* @param \Pimcore\Model\DataObject\Data\GeoCoordinates|null $location
* @return $this
*/
public function setLocation(?\Pimcore\Model\DataObject\Data\GeoCoordinates $location): static
{
	$this->markFieldDirty("location", true);

	$this->location = $location;

	return $this;
}

/**
* Get attributesAvailable - Attributes Available
* @return mixed
*/
public function getAttributesAvailable(): mixed
{
	$data = new \Pimcore\Model\DataObject\Data\CalculatedValue('attributesAvailable');
	$data->setContextualData("object", null, null, null);
	$object = $this;
	$data = \Pimcore\Model\DataObject\Service::getCalculatedFieldValue($object, $data);

	return $data;
}

/**
* Get saleInformationAvailable - Sale Information Available
* @return mixed
*/
public function getSaleInformationAvailable(): mixed
{
	$data = new \Pimcore\Model\DataObject\Data\CalculatedValue('saleInformationAvailable');
	$data->setContextualData("object", null, null, null);
	$object = $this;
	$data = \Pimcore\Model\DataObject\Service::getCalculatedFieldValue($object, $data);

	return $data;
}

/**
* Get imagesAvailable - Images Available
* @return mixed
*/
public function getImagesAvailable(): mixed
{
	$data = new \Pimcore\Model\DataObject\Data\CalculatedValue('imagesAvailable');
	$data->setContextualData("object", null, null, null);
	$object = $this;
	$data = \Pimcore\Model\DataObject\Service::getCalculatedFieldValue($object, $data);

	return $data;
}

/**
* Get objectType - Object Type
* @return string|null
*/
public function getObjectType(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("objectType");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->objectType;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("objectType")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("objectType");
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
* Set objectType - Object Type
* @param string|null $objectType
* @return $this
*/
public function setObjectType(?string $objectType): static
{
	$this->markFieldDirty("objectType", true);

	$this->objectType = $objectType;

	return $this;
}

/**
* Get urlSlug - UrlSlug
* @return \Pimcore\Model\DataObject\Data\UrlSlug[]
*/
public function getUrlSlug(): ?array
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("urlSlug");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->getClass()->getFieldDefinition("urlSlug")->preGetData($this);

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set urlSlug - UrlSlug
* @param \Pimcore\Model\DataObject\Data\UrlSlug[] $urlSlug
* @return $this
*/
public function setUrlSlug(?array $urlSlug): static
{
	/** @var \Pimcore\Model\DataObject\ClassDefinition\Data\UrlSlug $fd */
	$fd = $this->getClass()->getFieldDefinition("urlSlug");
	$hideUnpublished = \Pimcore\Model\DataObject\Concrete::getHideUnpublished();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished(false);
	$currentData = \Pimcore\Model\DataObject\Service::useInheritedValues(false, function() {
		return $this->getUrlSlug();
	});
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished($hideUnpublished);
	$isEqual = $fd->isEqual($currentData, $urlSlug);
	if (!$isEqual) {
		$this->markFieldDirty("urlSlug", true);
	}
	$this->urlSlug = $fd->preSetData($this, $urlSlug);
	return $this;
}

}

