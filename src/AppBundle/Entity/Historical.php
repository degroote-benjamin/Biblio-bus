<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $book;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(onDelete="CASCADE")
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

    /**
     * @return mixed
     */
    public function getBook()
    {
        return $this->book;
    }

    /**
     * @param mixed $book
     */
    public function setBook($book)
    {
        $this->book = $book;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }


}

