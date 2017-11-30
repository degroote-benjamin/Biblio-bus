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
     * @var User $adnumber
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="User")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="ad_number", referencedColumnName="Adherent_number")
     * })
     */
    private $ad_number;
    
     /**
      * @var Book $id_book
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Book", inversedBy="book")
      * @ORM\JoinColumns({
      * @ORM\JoinColumn(name="id_book", referencedColumnName="id")
      * })
     */
     private $id_book;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     */
    private $id;

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

    /**
     * Set idBook
     *
     * @param integer $idBook
     *
     * @return Historical
     */
    public function setIdBook($idBook)
    {
        $this->id_book = $idBook;

        return $this;
    }

    /**
     * Get idBook
     *
     * @return integer
     */
    public function getIdBook()
    {
        return $this->id_book;
    }
}
