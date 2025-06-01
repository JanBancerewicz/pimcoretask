<?php

namespace Pimcore\Model\DataObject\Car;

use Pimcore\Model\DataObject\Exception\InheritanceParentNotFoundException;

class Attributes extends \Pimcore\Model\DataObject\Objectbrick {

protected $brickGetters = ['Bodywork','Dimensions','Engine','Transmission'];


protected \Pimcore\Model\DataObject\Objectbrick\Data\Bodywork|null $Bodywork = null;

/**
* @return \Pimcore\Model\DataObject\Objectbrick\Data\Bodywork|null
*/
public function getBodywork(bool $includeDeletedBricks = false)
{
	if(!$this->Bodywork && \Pimcore\Model\DataObject::doGetInheritedValues($this->getObject())) { 
		try {
			$brickContainer = $this->getObject()->getValueFromParent("attributes");
			if(!empty($brickContainer)) {
				//check if parent object has brick, and if so, create an empty brick to enable inheritance
				$parentBrick = $this->getObject()->getValueFromParent("attributes")->getBodywork($includeDeletedBricks);
				if (!empty($parentBrick)) {
					$brickType = "\\Pimcore\\Model\\DataObject\\Objectbrick\\Data\\" . ucfirst($parentBrick->getType());
					$brick = new $brickType($this->getObject());
					$brick->setFieldname("attributes");
					$this->setBodywork($brick);
					return $brick;
				}
			}
		} catch (InheritanceParentNotFoundException $e) {
			// no data from parent available, continue ...
		}
	}
	if(!$includeDeletedBricks &&
		isset($this->Bodywork) &&
		$this->Bodywork->getDoDelete()) {
			return null;
	}
	return $this->Bodywork;
}

/**
* @param \Pimcore\Model\DataObject\Objectbrick\Data\Bodywork|null $Bodywork
* @return $this
*/
public function setBodywork(?\Pimcore\Model\DataObject\Objectbrick\Data\Bodywork $Bodywork): static
{
	$this->Bodywork = $Bodywork;
	return $this;
}

protected \Pimcore\Model\DataObject\Objectbrick\Data\Dimensions|null $Dimensions = null;

/**
* @return \Pimcore\Model\DataObject\Objectbrick\Data\Dimensions|null
*/
public function getDimensions(bool $includeDeletedBricks = false)
{
	if(!$this->Dimensions && \Pimcore\Model\DataObject::doGetInheritedValues($this->getObject())) { 
		try {
			$brickContainer = $this->getObject()->getValueFromParent("attributes");
			if(!empty($brickContainer)) {
				//check if parent object has brick, and if so, create an empty brick to enable inheritance
				$parentBrick = $this->getObject()->getValueFromParent("attributes")->getDimensions($includeDeletedBricks);
				if (!empty($parentBrick)) {
					$brickType = "\\Pimcore\\Model\\DataObject\\Objectbrick\\Data\\" . ucfirst($parentBrick->getType());
					$brick = new $brickType($this->getObject());
					$brick->setFieldname("attributes");
					$this->setDimensions($brick);
					return $brick;
				}
			}
		} catch (InheritanceParentNotFoundException $e) {
			// no data from parent available, continue ...
		}
	}
	if(!$includeDeletedBricks &&
		isset($this->Dimensions) &&
		$this->Dimensions->getDoDelete()) {
			return null;
	}
	return $this->Dimensions;
}

/**
* @param \Pimcore\Model\DataObject\Objectbrick\Data\Dimensions|null $Dimensions
* @return $this
*/
public function setDimensions(?\Pimcore\Model\DataObject\Objectbrick\Data\Dimensions $Dimensions): static
{
	$this->Dimensions = $Dimensions;
	return $this;
}

protected \Pimcore\Model\DataObject\Objectbrick\Data\Engine|null $Engine = null;

/**
* @return \Pimcore\Model\DataObject\Objectbrick\Data\Engine|null
*/
public function getEngine(bool $includeDeletedBricks = false)
{
	if(!$this->Engine && \Pimcore\Model\DataObject::doGetInheritedValues($this->getObject())) { 
		try {
			$brickContainer = $this->getObject()->getValueFromParent("attributes");
			if(!empty($brickContainer)) {
				//check if parent object has brick, and if so, create an empty brick to enable inheritance
				$parentBrick = $this->getObject()->getValueFromParent("attributes")->getEngine($includeDeletedBricks);
				if (!empty($parentBrick)) {
					$brickType = "\\Pimcore\\Model\\DataObject\\Objectbrick\\Data\\" . ucfirst($parentBrick->getType());
					$brick = new $brickType($this->getObject());
					$brick->setFieldname("attributes");
					$this->setEngine($brick);
					return $brick;
				}
			}
		} catch (InheritanceParentNotFoundException $e) {
			// no data from parent available, continue ...
		}
	}
	if(!$includeDeletedBricks &&
		isset($this->Engine) &&
		$this->Engine->getDoDelete()) {
			return null;
	}
	return $this->Engine;
}

/**
* @param \Pimcore\Model\DataObject\Objectbrick\Data\Engine|null $Engine
* @return $this
*/
public function setEngine(?\Pimcore\Model\DataObject\Objectbrick\Data\Engine $Engine): static
{
	$this->Engine = $Engine;
	return $this;
}

protected \Pimcore\Model\DataObject\Objectbrick\Data\Transmission|null $Transmission = null;

/**
* @return \Pimcore\Model\DataObject\Objectbrick\Data\Transmission|null
*/
public function getTransmission(bool $includeDeletedBricks = false)
{
	if(!$this->Transmission && \Pimcore\Model\DataObject::doGetInheritedValues($this->getObject())) { 
		try {
			$brickContainer = $this->getObject()->getValueFromParent("attributes");
			if(!empty($brickContainer)) {
				//check if parent object has brick, and if so, create an empty brick to enable inheritance
				$parentBrick = $this->getObject()->getValueFromParent("attributes")->getTransmission($includeDeletedBricks);
				if (!empty($parentBrick)) {
					$brickType = "\\Pimcore\\Model\\DataObject\\Objectbrick\\Data\\" . ucfirst($parentBrick->getType());
					$brick = new $brickType($this->getObject());
					$brick->setFieldname("attributes");
					$this->setTransmission($brick);
					return $brick;
				}
			}
		} catch (InheritanceParentNotFoundException $e) {
			// no data from parent available, continue ...
		}
	}
	if(!$includeDeletedBricks &&
		isset($this->Transmission) &&
		$this->Transmission->getDoDelete()) {
			return null;
	}
	return $this->Transmission;
}

/**
* @param \Pimcore\Model\DataObject\Objectbrick\Data\Transmission|null $Transmission
* @return $this
*/
public function setTransmission(?\Pimcore\Model\DataObject\Objectbrick\Data\Transmission $Transmission): static
{
	$this->Transmission = $Transmission;
	return $this;
}

}

