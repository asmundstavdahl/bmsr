<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeRepository")
 */
class Type
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="text")
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Thing", mappedBy="type")
     *
     * @var Thing[]
     */
    private $things;

    /**
     * @ORM\OneToMany(targetEntity="Property", mappedBy="type")
     *
     * @var Property[]
     */
    private $properties;

    /**
     * @return Property[]
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * @param Property[] $properties
     */
    public function setProperties($properties)
    {
        $this->properties = $properties;
    }

    /**
     * @return Thing[]
     */
    public function getThings()
    {
        return $this->things;
    }

    /**
     * @param Thing $things
     */
    public function setThings($things)
    {
        $this->things = $things;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Count the number of things of this Type.
     *
     * @return number
     */
    public function getCount()
    {
        return count($this->getThings());
    }
}
