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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Book")
     */
    private $book;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $user;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
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

