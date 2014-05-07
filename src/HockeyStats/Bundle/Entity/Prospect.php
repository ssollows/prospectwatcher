<?php

namespace HockeyStats\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Prospect
 */
class Prospect
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $prospectID;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Prospect
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set prospectID
     *
     * @param integer $prospectID
     * @return Prospect
     */
    public function setProspectID($prospectID)
    {
        $this->prospectID = $prospectID;

        return $this;
    }

    /**
     * Get prospectID
     *
     * @return integer 
     */
    public function getProspectID()
    {
        return $this->prospectID;
    }
}
