<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ThingRepository")
 */
class Thing
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Type", inversedBy="things")
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="ThingValue", mappedBy="thing")
     *
     * @var ThingValue[]
     */
    private $thingValues;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="thing")
     *
     * @var Comment[]
     */
    private $comments;

    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @return \App\Entity\ThingValue[]
     */
    public function getThingValues()
    {
        $thingValues = $this->thingValues;

        $properties = $this->getType()->getProperties();

        foreach ($properties as $property) {
            $foundThingValueForProperty = false;
            foreach ($thingValues as $thingValue) {
                if ($thingValue->getProperty() == $property) {
                    $foundThingValueForProperty = true;
                    break;
                }
            }
            if (!$foundThingValueForProperty) {
                $thingValueForThisProperty = new ThingValue();
                $thingValueForThisProperty->setProperty($property);
                $thingValueForThisProperty->setThing($this);
                $thingValueForThisProperty->setValue($property->getDefaultValue());
                $this->thingValues[] = $thingValueForThisProperty;
            }
        }

        return $this->thingValues;
    }

    /**
     * @param \App\Entity\ThingValue[] $thingValues
     */
    public function setThingValues($thingValues)
    {
        $this->thingValues = $thingValues;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \App\Entity\Type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * $param \App\Entity\Type $type.
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getName()
    {
        $typeProperties = $this->getType()->getProperties();

        if (0 == count($typeProperties)) {
            return $this->getType()->getName().'#'.$this->getId();
        } else {
            foreach ($this->getThingValues() as $thingValue) {
                if ($thingValue->getProperty() == $typeProperties[0]) {
                    return $thingValue->getValue();
                }
            }

            return 'Something (could not resolve name)';
        }
    }
}
