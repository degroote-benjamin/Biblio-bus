<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Book;
use AppBundle\Entity\Historical;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * Lists all book entities.
     *
     * @Route("/", name="homepage")
     * @Method({"GET", "POST"})
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        if(isset($_POST['avaiblereturn'])) {
            $books = $em->getRepository('AppBundle:Book')->findOneBy(['id' => $_POST['id']]);
            if(isset($_POST['id_user'])){
                $historical = new Historical();
                $books->setAvaible(false);
                $users = $em->getRepository('AppBundle:User')->findOneBy(['id' => $_POST['id_user']]);
                $historical->setUser($users);
                $historical->setReturnBook(false);
            }
            else{
                $historical = $em->getRepository('AppBundle:Historical')->findOneBy(['book' => $_POST['id']]);
                $books->setAvaible(true);
                dump($historical);
                $historical->setReturnBook(1);
            }
            $historical->setBook($books);
            dump($historical);
            $em->persist($historical);
            $em->persist($books);
            $em->flush();

        }
        $books = $em->getRepository('AppBundle:Book')->findAll();
        $books1 = $em->getRepository('AppBundle:Book')->category();
        return $this->render('book/index.html.twig', array(
            'books' => $books,
            'categorys'=> $books1,
        ));
    }

    /**
     * Creates a new book entity.
     *
     * @Route("/sort", name="sort")
     * @Method({"GET", "POST"})
     */
    public function newAction()
    {
        $em = $this->getDoctrine()->getManager();
        $books = $em->getRepository('AppBundle:Book')->findBy(['category' => $_POST['category']]);

        $books1 = $em->getRepository('AppBundle:Book')->category();
        return $this->render('book/index.html.twig', array(
            'books' => $books,
            'categorys'=> $books1,
        ));
    }
}
