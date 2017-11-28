<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Historical
 *
 * @ORM\Table(name="historical")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HistoricalRepository")
 */
class Historical
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     */
    private $id_book;

    /**
     * @var string
     *
     * @ORM\Column(name="Adherent_number", type="string", length=255, unique=true)
     */
    private $adherentNumber;

    /**
     * @var bool
     *
     * @ORM\Column(name="Return_book", type="boolean")
     */
    private $returnBook;


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
     * @return Historical
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

    /**
     * Set returnBook
     *
     * @param boolean $returnBook
     *
     * @return Historical
     */
    public function setReturnBook($returnBook)
    {
        $this->returnBook = $returnBook;

        return $this;
    }

    /**
     * Get returnBook
     *
     * @return bool
     */
    public function getReturnBook()
    {
        return $this->returnBook;
    }
}

