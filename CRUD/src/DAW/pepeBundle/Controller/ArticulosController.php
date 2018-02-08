<?php

namespace DAW\pepeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticulosController extends Controller

{
    public function listAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $articulos = $em->getRepository('DAWpepeBundle:Articles')->findAll();

        return $this->render('DAWpepeBundle:Articulos:Articulos/showall.html.twig', array('articulos'=>$articulos));
    }

    public function newAction()
    {
        $articulo = new Articles();
        $articulo->setTitle('Articulo de alexsander');
        $articulo->setAuthor('John Doe');
        $articulo->setContent('Contenido');
        $articulo->setTags('ejemplo');
        $articulo->setCreated(new \DateTime());
        $articulo->setUpdated(new \DateTime());
        $articulo->setSlug('articulo-de-alexsander');
        $articulo->setCategory('ejemplo');

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($articulo);
        $em->flush();

        return $this->render('DAWpepeBundle:Articulos:Articulos/show.html.twig', array('articulo'=>$articulo));

    }

    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $articulo = $em->getRepository('DAWpepeBundle:Articles')->find($id);

        $articulo->setTitle('Articulo de ALEXSANDER - modificado');
        $articulo->setUpdated(new \DateTime());

        $em->persist($articulo);
        $em->flush();

        return $this->render('DAWpepeBundle:Articulos:Articulos/show.html.twig', array('articulo' => $articulo));

    }

    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $articulo = $em->getRepository('DAWpepeBundle:Articles')->find($id);

        return $this->render('DAWpepeBundle:Articulos:Articulos/show.html.twig', array('articulo' => $articulo));


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
