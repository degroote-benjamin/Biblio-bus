<?php

namespace AppBundle\Controller;

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
