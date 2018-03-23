<?php

namespace Triburch\Backend\JuegosBundle\Controller;


use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Triburch\Backend\JuegosBundle\Entity\Categoria;
use Triburch\Backend\JuegosBundle\Entity\Joc;
use Triburch\Backend\JuegosBundle\Forms\Type\Categorias\CategoriasType;

class CategoriasController extends Controller
{

    public function newAction()
    {
        $request = $this->getRequest();
        $categoria = new Categoria();
        $form = $this->createForm(new CategoriasType(),$categoria,array(
            'action' => $this->generateUrl('categoria_new'),
            'method' => 'POST',
            'attr'=>array('id' => 'contact'))

        );
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
            'attr'=>array('id' => 'contact')


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
        $jocs=$em->getRepository('TriburchBackendJuegosBundle:Joc')->findBy(array('categoria'=>$id));



        return $this->render('TriburchBackendJuegosBundle:Jocs:list.html.twig', array('jocs' => $jocs));



    }









}
