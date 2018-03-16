<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PropertyRepository")
 */
class Property
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    private $name;
    
    /**
     * @ORM\Column(type="text")
     * @var string
     */
    private $default_value;
    
    /**
     * @ORM\ManyToOne(targetEntity="Type", inversedBy="properties")
     * @var Type
     */
    private $type;
    
    /**
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @var integer
     */
    private $sortnum;
    
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDefaultValue()
    {
        return $this->default_value;
    }

    /**
     * @return Type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return number
     */
    public function getSortnum()
    {
        return $this->sortnum;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $default_value
     */
    public function setDefaultValue($default_value)
    {
        $this->default_value = $default_value;
    }

    /**
     * @param Type $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @param integer $sortnum
     */
    public function setSortnum($sortnum)
    {
        $this->sortnum = $sortnum;
    }

    
    
}
