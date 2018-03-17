<?php

namespace Triburch\Backend\JuegosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Triburch\Backend\JuegosBundle\Entity\Categoria;
use Triburch\Backend\JuegosBundle\Forms\Type\CategoriasType;

class CategoriasController extends Controller
{

    public function newAction()
    {
        $request = $this->getRequest();
        $categoria = new Categoria();
        $form = $this->createForm(new CategoriasType(),$categoria,array(
            'action' => $this->generateUrl('categoria_new'),
            'method' => 'POST'));
        if($request->getMethod() == 'POST')
        {

            $form->handleRequest($request);


            if($form->isValid())
            {

                $em = $this->getDoctrine()->getManager();
                $em->persist($categoria);
                $em->flush();

                return $this->redirect($this->generateURL('categoria_list'));
            }
        }
        return $this->render('TriburchBackendJuegosBundle:Categorias:show.html.twig', array('form' => $form->createView()));


    }


    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categorias = $em->getRepository('TriburchBackendJuegosBundle:Categoria')->findAll();


        return $this->render('TriburchBackendJuegosBundle:Categorias:list.html.twig', array('categorias'=>$categorias));
    }



    public function editAction($id){

        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $categoria = $em->getRepository('TriburchBackendJuegosBundle:Categoria')->find($id);
        $form = $this->createForm(new CategoriasType(),$categoria,array(
            'action' => $this->generateUrl('categoria_edit',array('id'=>$id)),
            'method' => 'PUT',


        ));

        if($request->getMethod() == 'PUT')
        {

            $form->handleRequest($request);


            if($form->isValid())
            {

                $em = $this->getDoctrine()->getManager();
                $em->persist($categoria);
                $em->flush();

                return $this->redirect($this->generateURL('categoria_list'));
            }
        }


        return $this->render('TriburchBackendJuegosBundle:Categorias:show.html.twig', array('form' => $form->createView()));




    }


    public function eraseAction($id){


        $em = $this->getDoctrine()->getManager();

        $categoria = $em->getRepository('TriburchBackendJuegosBundle:Categoria')->find($id);

        $em->remove($categoria);
        $em->flush();

        return $this->redirect($this->generateURL('categoria_list'));

    }


    public function listchildAction($id){

        $em = $this->getDoctrine()->getManager();

        $categoria = $em->getRepository('TriburchBackendJuegosBundle:Categoria')->find($id);

        return $this->render('TriburchBackendJuegosBundle:Jocs:list.html.twig', array('jocs' => $categoria->getJocs()));



    }







}
