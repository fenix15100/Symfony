<?php

namespace DAW\pepeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DAW\pepeBundle\Entity\Articles;
use DAW\pepeBundle\Forms\ArticleType;



class ArticulosController extends Controller

{
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();

        $articulos = $em->getRepository('DAWpepeBundle:Articles')->findAll();

        return $this->render('DAWpepeBundle:Articulos:showall.html.twig', array('articulos'=>$articulos));
    }

    public function newAction()
    {
        $request = $this->getRequest();
        $articulo = new Articles();
        $form = $this->createForm(new ArticleType(), $articulo);


        if($request->getMethod() == 'POST')
        {

            $form->handleRequest($request);


            if($form->isValid())
            {

                $em = $this->getDoctrine()->getManager();
                $em->persist($articulo);
                $em->flush();

                return $this->redirect($this->generateURL('articulo_listar'));
            }
        }

        return $this->render('DAWpepeBundle:Articulos:new.html.twig', array(
            'form' => $form->createView(),
        ));




    }




    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $articulo = $em->getRepository('DAWpepeBundle:Articles')->find($id);

        $articulo->setTitle('Articulo de ALEXSANDER - modificado');
        $articulo->setUpdated(new \DateTime());

        $em->persist($articulo);
        $em->flush();

        return $this->render('DAWpepeBundle:Articulos:show.html.twig', array('articulo' => $articulo));

    }

    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $articulo = $em->getRepository('DAWpepeBundle:Articles')->find($id);

        return $this->render('DAWpepeBundle:Articulos:show.html.twig', array('articulo' => $articulo));


    }

    public function eraseAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $articulo = $em->getRepository('DAWpepeBundle:Articles')->find($id);

        $em->remove($articulo);
        $em->flush();

        return $this->redirect(
            $this->generateUrl('articulo_listar'));


    }



}
