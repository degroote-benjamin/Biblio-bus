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
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if($request->isMethod('POST')) {
            dump($request);
            $books = $em->getRepository('AppBundle:Book')->findOneBy(['id' => $request->get('id')]);
            if($request->request->has('id_user')){
                $historical = new Historical();
                $books->setAvaible(false);
                $users = $em->getRepository('AppBundle:User')->findOneBy(['id' => $request->get('id_user')]);
                $historical->setUser($users);
                $historical->setReturnBook(false);
            }
            else{
                // find last historical info for this book
                $historical = $em->getRepository('AppBundle:Historical')->findOneBy(
                    array('book'=>$request->get('id')),
                    array('id' => 'DESC'));
                $books->setAvaible(true);
                $historical->setReturnBook(1);
            }
            $historical->setBook($books);
            $em->persist($historical);
            $em->persist($books);
            $em->flush();

        }
        // take all book
        $books = $em->getRepository('AppBundle:Book')->findAll();
        // take distinct category for allbook
        $books1 = $em->getRepository('AppBundle:Book')->category();
        return $this->render('book/index.html.twig', array(
            'books' => $books,
            'categorys'=> $books1,
        ));
    }

    /**
     * Creates a new book entity.
     *
     * @Route("/sort/{category}", name="sort")
     * @Method({"GET", "POST"})
     */
    public function newAction($category)
    {
        $em = $this->getDoctrine()->getManager();
        $books = $em->getRepository('AppBundle:Book')->findBy(['category' => $category]);

        $books1 = $em->getRepository('AppBundle:Book')->category();
        return $this->render('book/index.html.twig', array(
            'books' => $books,
            'categorys'=> $books1,
        ));
    }
}
