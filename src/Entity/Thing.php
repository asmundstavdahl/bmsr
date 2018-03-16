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
     * @return \App\Entity\ThingValue[]
     */
    public function getThingValues()
    {
        return $this->thingValues;
    }

    /**
     * @param \App\Entity\ThingValue[] $thingValues
     */
    public function setThingValues($thingValues)
    {
        $this->thingValues = $thingValues;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        return $this->type = $type;
    }

    public function getTitle()
    {
        return $this->name ?? $this->id;
    }
}
