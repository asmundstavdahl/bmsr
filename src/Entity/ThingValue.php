<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ThingValueRepository")
 */
class ThingValue
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Property")
     *
     * @var Property
     */
    private $property;

    /**
     * @ORM\ManyToOne(targetEntity="Thing", inversedBy="thingValues")
     *
     * @var Thing
     */
    private $thing;

    /**
     * @ORM\Column(type="text")
     *
     * @var string
     */
    private $value;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \App\Entity\Property
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * @return \App\Entity\Thing
     */
    public function getThing()
    {
        return $this->thing;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param \App\Entity\Property $property
     */
    public function setProperty($property)
    {
        $this->property = $property;
    }

    /**
     * @param \App\Entity\Thing $thing
     */
    public function setThing($thing)
    {
        $this->thing = $thing;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}
