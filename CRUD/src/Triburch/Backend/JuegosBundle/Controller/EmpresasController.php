<?php

namespace Triburch\Backend\JuegosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Triburch\Backend\JuegosBundle\Entity\Empresa;
use Triburch\Backend\JuegosBundle\Forms\Type\Empresas\EmpresaType;

class EmpresasController extends Controller
{

    public function newAction()
    {
        $request = $this->getRequest();
        $empresa = new Empresa();
        $form = $this->createForm(new EmpresaType(),$empresa,array(
            'action' => $this->generateUrl('empresa_new'),
            'method' => 'POST',
            'attr'=>array('id' => 'contact'))

        );
        if($request->getMethod() == 'POST')
        {

            $form->handleRequest($request);


            if($form->isValid())
            {

                $em = $this->getDoctrine()->getManager();
                $empresa->prePersistController('PEPITO');
                $em->persist($empresa);
                $em->flush();

                return $this->redirect($this->generateURL('empresa_list'));
            }
        }
        return $this->render('TriburchBackendJuegosBundle:Empresas:show.html.twig', array('form' => $form->createView()));


    }


    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();

        $empresas = $em->getRepository('TriburchBackendJuegosBundle:Empresa')->findAll();

        return $this->render('TriburchBackendJuegosBundle:Empresas:list.html.twig', array('empresas'=>$empresas));

    }



    public function editAction($id){

        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $empresa = $em->getRepository('TriburchBackendJuegosBundle:Empresa')->find($id);
        $form = $this->createForm(new EmpresaType(),$empresa,array(
            'action' => $this->generateUrl('empresa_edit',array('id'=>$id)),
            'method' => 'PUT',
            'attr'=>array('id' => 'contact')


        ));

        if($request->getMethod() == 'PUT')
        {

            $form->handleRequest($request);


            if($form->isValid())
            {

                $em = $this->getDoctrine()->getManager();
                $empresa->prePersistController('JUAN');
                $em->persist($empresa);
                $em->flush();

                return $this->redirect($this->generateURL('empresa_list'));
            }
        }


        return $this->render('TriburchBackendJuegosBundle:Empresas:show.html.twig', array('form' => $form->createView()));




    }


    public function eraseAction($id){


        $em = $this->getDoctrine()->getManager();

        $empresa = $em->getRepository('TriburchBackendJuegosBundle:Empresa')->find($id);

        $em->remove($empresa);
        $em->flush();

        return $this->redirect($this->generateURL('empresa_list'));

    }











}
