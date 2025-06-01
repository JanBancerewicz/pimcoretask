<?php

/**
 * Inheritance: no
 * Variants: no
 *
 * Fields Summary:
 * - localizedfields [localizedfields]
 * -- generatedName [calculatedValue]
 * -- nameAddition [input]
 * - manufacturer [manyToOneRelation]
 * - series [manyToOneRelation]
 * - mainCategory [manyToOneRelation]
 * - compatibleTo [manyToManyObjectRelation]
 * - technicalAttributes [classificationstore]
 * - image [hotspotimage]
 * - additionalCategories [manyToManyObjectRelation]
 * - erpNumber [input]
 * - categoryCode [input]
 * - owner [input]
 * - saleInformation [objectbricks]
 * - urlSlug [urlSlug]
 */

namespace Pimcore\Model\DataObject;

use Pimcore\Model\DataObject\Exception\InheritanceParentNotFoundException;
use Pimcore\Model\DataObject\PreGetValueHookInterface;

/**
* @method static \Pimcore\Model\DataObject\AccessoryPart\Listing getList(array $config = [])
* @method static \Pimcore\Model\DataObject\AccessoryPart\Listing|\Pimcore\Model\DataObject\AccessoryPart|null getByLocalizedfields(string $field, mixed $value, ?string $locale = null, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\AccessoryPart\Listing|\Pimcore\Model\DataObject\AccessoryPart|null getByGeneratedName(mixed $value, ?string $locale = null, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\AccessoryPart\Listing|\Pimcore\Model\DataObject\AccessoryPart|null getByNameAddition(mixed $value, ?string $locale = null, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\AccessoryPart\Listing|\Pimcore\Model\DataObject\AccessoryPart|null getByManufacturer(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\AccessoryPart\Listing|\Pimcore\Model\DataObject\AccessoryPart|null getBySeries(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\AccessoryPart\Listing|\Pimcore\Model\DataObject\AccessoryPart|null getByMainCategory(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\AccessoryPart\Listing|\Pimcore\Model\DataObject\AccessoryPart|null getByCompatibleTo(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\AccessoryPart\Listing|\Pimcore\Model\DataObject\AccessoryPart|null getByAdditionalCategories(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\AccessoryPart\Listing|\Pimcore\Model\DataObject\AccessoryPart|null getByErpNumber(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\AccessoryPart\Listing|\Pimcore\Model\DataObject\AccessoryPart|null getByCategoryCode(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\AccessoryPart\Listing|\Pimcore\Model\DataObject\AccessoryPart|null getByOwner(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\AccessoryPart\Listing|\Pimcore\Model\DataObject\AccessoryPart|null getByUrlSlug(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
*/

class AccessoryPart extends \App\Model\Product\AbstractProduct
{
public const FIELD_GENERATED_NAME = 'generatedName';
public const FIELD_NAME_ADDITION = 'nameAddition';
public const FIELD_MANUFACTURER = 'manufacturer';
public const FIELD_SERIES = 'series';
public const FIELD_MAIN_CATEGORY = 'mainCategory';
public const FIELD_COMPATIBLE_TO = 'compatibleTo';
public const FIELD_TECHNICAL_ATTRIBUTES = 'technicalAttributes';
public const FIELD_IMAGE = 'image';
public const FIELD_ADDITIONAL_CATEGORIES = 'additionalCategories';
public const FIELD_ERP_NUMBER = 'erpNumber';
public const FIELD_CATEGORY_CODE = 'categoryCode';
public const FIELD_OWNER = 'owner';
public const FIELD_SALE_INFORMATION = 'saleInformation';
public const FIELD_URL_SLUG = 'urlSlug';

protected $classId = "AP";
protected $className = "AccessoryPart";
protected $localizedfields;
protected $manufacturer;
protected $series;
protected $mainCategory;
protected $compatibleTo;
protected $technicalAttributes;
protected $image;
protected $additionalCategories;
protected $erpNumber;
protected $categoryCode;
protected $owner;
protected $saleInformation;
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

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Get generatedName - Fullname
* @return mixed
*/
public function getGeneratedName(?string $language = null): mixed
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
	$fieldDefinition = $this->getClass()->getFieldDefinition("localizedfields")->getFieldDefinition("generatedName");
	$data = new \Pimcore\Model\DataObject\Data\CalculatedValue('generatedName');
	$data->setContextualData("localizedfield", "localizedfields", null, $language, null, null, $fieldDefinition);
	$data = \Pimcore\Model\DataObject\Service::getCalculatedFieldValue($object, $data);
	return $data;
}

/**
* Get nameAddition - Name Addition
* @return string|null
*/
public function getNameAddition(?string $language = null): ?string
{
	$data = $this->getLocalizedfields()->getLocalizedValue("nameAddition", $language);
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("nameAddition");
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
* Set nameAddition - Name Addition
* @param string|null $nameAddition
* @return $this
*/
public function setNameAddition (?string $nameAddition, ?string $language = null): static
{
	$isEqual = false;
	$this->getLocalizedfields()->setLocalizedValue("nameAddition", $nameAddition, $language, !$isEqual);

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
	$currentData = $this->getManufacturer();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished($hideUnpublished);
	$isEqual = $fd->isEqual($currentData, $manufacturer);
	if (!$isEqual) {
		$this->markFieldDirty("manufacturer", true);
	}
	$this->manufacturer = $fd->preSetData($this, $manufacturer);
	return $this;
}

/**
* Get series - Series
* @return \App\Model\Product\Car|null
*/
public function getSeries(): ?\Pimcore\Model\Element\AbstractElement
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("series");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->getClass()->getFieldDefinition("series")->preGetData($this);

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set series - Series
* @param \App\Model\Product\Car|null $series
* @return $this
*/
public function setSeries(?\Pimcore\Model\Element\AbstractElement $series): static
{
	/** @var \Pimcore\Model\DataObject\ClassDefinition\Data\ManyToOneRelation $fd */
	$fd = $this->getClass()->getFieldDefinition("series");
	$hideUnpublished = \Pimcore\Model\DataObject\Concrete::getHideUnpublished();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished(false);
	$currentData = $this->getSeries();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished($hideUnpublished);
	$isEqual = $fd->isEqual($currentData, $series);
	if (!$isEqual) {
		$this->markFieldDirty("series", true);
	}
	$this->series = $fd->preSetData($this, $series);
	return $this;
}

/**
* Get mainCategory - Main Category
* @return \App\Model\Product\Category|null
*/
public function getMainCategory(): ?\Pimcore\Model\Element\AbstractElement
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("mainCategory");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->getClass()->getFieldDefinition("mainCategory")->preGetData($this);

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set mainCategory - Main Category
* @param \App\Model\Product\Category|null $mainCategory
* @return $this
*/
public function setMainCategory(?\Pimcore\Model\Element\AbstractElement $mainCategory): static
{
	/** @var \Pimcore\Model\DataObject\ClassDefinition\Data\ManyToOneRelation $fd */
	$fd = $this->getClass()->getFieldDefinition("mainCategory");
	$hideUnpublished = \Pimcore\Model\DataObject\Concrete::getHideUnpublished();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished(false);
	$currentData = $this->getMainCategory();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished($hideUnpublished);
	$isEqual = $fd->isEqual($currentData, $mainCategory);
	if (!$isEqual) {
		$this->markFieldDirty("mainCategory", true);
	}
	$this->mainCategory = $fd->preSetData($this, $mainCategory);
	return $this;
}

/**
* Get compatibleTo - Compatible To
* @return \App\Model\Product\Car[]
*/
public function getCompatibleTo(): array
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("compatibleTo");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->getClass()->getFieldDefinition("compatibleTo")->preGetData($this);

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set compatibleTo - Compatible To
* @param \App\Model\Product\Car[] $compatibleTo
* @return $this
*/
public function setCompatibleTo(?array $compatibleTo): static
{
	/** @var \Pimcore\Model\DataObject\ClassDefinition\Data\ManyToManyObjectRelation $fd */
	$fd = $this->getClass()->getFieldDefinition("compatibleTo");
	$hideUnpublished = \Pimcore\Model\DataObject\Concrete::getHideUnpublished();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished(false);
	$currentData = $this->getCompatibleTo();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished($hideUnpublished);
	$isEqual = $fd->isEqual($currentData, $compatibleTo);
	if (!$isEqual) {
		$this->markFieldDirty("compatibleTo", true);
	}
	$this->compatibleTo = $fd->preSetData($this, $compatibleTo);
	return $this;
}

/**
* Get technicalAttributes - Technical Attributes
* @return \Pimcore\Model\DataObject\Classificationstore|null
*/
public function getTechnicalAttributes(): ?\Pimcore\Model\DataObject\Classificationstore
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("technicalAttributes");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->getClass()->getFieldDefinition("technicalAttributes")->preGetData($this);

	return $data;
}

/**
* Set technicalAttributes - Technical Attributes
* @param \Pimcore\Model\DataObject\Classificationstore|null $technicalAttributes
* @return $this
*/
public function setTechnicalAttributes(?\Pimcore\Model\DataObject\Classificationstore $technicalAttributes): static
{
	$this->markFieldDirty("technicalAttributes", true);

	$this->technicalAttributes = $technicalAttributes;

	return $this;
}

/**
* Get image - image
* @return \Pimcore\Model\DataObject\Data\Hotspotimage|null
*/
public function getImage(): ?\Pimcore\Model\DataObject\Data\Hotspotimage
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("image");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->image;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set image - image
* @param \Pimcore\Model\DataObject\Data\Hotspotimage|null $image
* @return $this
*/
public function setImage(?\Pimcore\Model\DataObject\Data\Hotspotimage $image): static
{
	$this->markFieldDirty("image", true);

	$this->image = $image;

	return $this;
}

/**
* Get additionalCategories - Additional Categories
* @return \App\Model\Product\Category[]
*/
public function getAdditionalCategories(): array
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("additionalCategories");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->getClass()->getFieldDefinition("additionalCategories")->preGetData($this);

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set additionalCategories - Additional Categories
* @param \App\Model\Product\Category[] $additionalCategories
* @return $this
*/
public function setAdditionalCategories(?array $additionalCategories): static
{
	/** @var \Pimcore\Model\DataObject\ClassDefinition\Data\ManyToManyObjectRelation $fd */
	$fd = $this->getClass()->getFieldDefinition("additionalCategories");
	$hideUnpublished = \Pimcore\Model\DataObject\Concrete::getHideUnpublished();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished(false);
	$currentData = $this->getAdditionalCategories();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished($hideUnpublished);
	$isEqual = $fd->isEqual($currentData, $additionalCategories);
	if (!$isEqual) {
		$this->markFieldDirty("additionalCategories", true);
	}
	$this->additionalCategories = $fd->preSetData($this, $additionalCategories);
	return $this;
}

/**
* Get erpNumber - ERP Number
* @return string|null
*/
public function getErpNumber(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("erpNumber");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->erpNumber;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set erpNumber - ERP Number
* @param string|null $erpNumber
* @return $this
*/
public function setErpNumber(?string $erpNumber): static
{
	$this->markFieldDirty("erpNumber", true);

	$this->erpNumber = $erpNumber;

	return $this;
}

/**
* Get categoryCode - Category Code
* @return string|null
*/
public function getCategoryCode(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("categoryCode");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->categoryCode;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set categoryCode - Category Code
* @param string|null $categoryCode
* @return $this
*/
public function setCategoryCode(?string $categoryCode): static
{
	$this->markFieldDirty("categoryCode", true);

	$this->categoryCode = $categoryCode;

	return $this;
}

/**
* Get owner - Owner
* @return string|null
*/
public function getOwner(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("owner");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->owner;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set owner - Owner
* @param string|null $owner
* @return $this
*/
public function setOwner(?string $owner): static
{
	$this->markFieldDirty("owner", true);

	$this->owner = $owner;

	return $this;
}

/**
* @return \Pimcore\Model\DataObject\AccessoryPart\SaleInformation
*/
public function getSaleInformation(): ?\Pimcore\Model\DataObject\Objectbrick
{
	$data = $this->saleInformation;
	if (!$data) {
		if (\Pimcore\Tool::classExists("\\Pimcore\\Model\\DataObject\\AccessoryPart\\SaleInformation")) {
			$data = new \Pimcore\Model\DataObject\AccessoryPart\SaleInformation($this, "saleInformation");
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
* Set saleInformation - 
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
	$currentData = $this->getUrlSlug();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished($hideUnpublished);
	$isEqual = $fd->isEqual($currentData, $urlSlug);
	if (!$isEqual) {
		$this->markFieldDirty("urlSlug", true);
	}
	$this->urlSlug = $fd->preSetData($this, $urlSlug);
	return $this;
}

}

