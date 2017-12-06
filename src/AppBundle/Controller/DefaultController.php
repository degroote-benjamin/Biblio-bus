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
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $books = $em->getRepository('AppBundle:Book')->findBy(['category' =>$request->get('category')]);

        $books1 = $em->getRepository('AppBundle:Book')->category();
        return $this->render('book/index.html.twig', array(
            'books' => $books,
            'categorys'=> $books1,
        ));
    }
}
