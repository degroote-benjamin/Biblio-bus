<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Adherent_number", type="string", length=255, unique=true)
     */
    private $adherentNumber;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set adherentNumber
     *
     * @param string $adherentNumber
     *
     * @return User
     */
    public function setAdherentNumber($adherentNumber)
    {
        $this->adherentNumber = $adherentNumber;

        return $this;
    }

    /**
     * Get adherentNumber
     *
     * @return string
     */
    public function getAdherentNumber()
    {
        return $this->adherentNumber;
    }
}

