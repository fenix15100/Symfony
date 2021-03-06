<?php

namespace Triburch\Backend\JuegosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Triburch\Backend\JuegosBundle\Entity\Joc;
use Triburch\Backend\JuegosBundle\Forms\Type\Jocs\JocsType;


class JocsController extends Controller
{
    public function newAction()
    {
        $request = $this->getRequest();
        $joc = new Joc();
        $form = $this->createForm(new JocsType(),$joc,array(
            'action' => $this->generateUrl('joc_new'),
            'method' => 'POST',
            'attr'=>array('id' => 'contact')));
       if($request->getMethod() == 'POST') {
           $em = $this->getDoctrine()->getManager();


           $joc->setNom($_POST['joc_form']['nom']);
           $joc->setImatge($_POST['joc_form']['imatge']);
           $categoria = $em->getRepository('TriburchBackendJuegosBundle:Categoria')->find($_POST['joc_form']['categoria']);
           $joc->setCategoria($categoria);
           $errores = $this->get('validator')->validate($joc);

           if (count($errores)>0) {
               return $this->render('TriburchBackendJuegosBundle:Jocs:show.html.twig', array('form' => $form->createView(), 'errores' => $errores));
           }else{
               $em->persist($joc);
               $em->flush();
           }

           return $this->redirect($this->generateURL('joc_list'));

       }
        return $this->render('TriburchBackendJuegosBundle:Jocs:show.html.twig', array('form' => $form->createView()));


    }


    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();

        $jocs = $em->getRepository('TriburchBackendJuegosBundle:Joc')->findAll();


        return $this->render('TriburchBackendJuegosBundle:Jocs:list.html.twig', array('jocs'=>$jocs));
    }

    public function editAction($id){

        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $joc = $em->getRepository('TriburchBackendJuegosBundle:Joc')->find($id);
        $form = $this->createForm(new JocsType(),$joc,array(
            'action' => $this->generateUrl('joc_edit',array('id'=>$id)),
            'method' => 'PUT',
            'attr'=>array('id' => 'contact')


        ));

        if($request->getMethod() == 'PUT')
        {
            $em = $this->getDoctrine()->getManager();
            $joc->setNom($_POST['joc_form']['nom']);
            $joc->setImatge($_POST['joc_form']['imatge']);
            $categoria=$em->getRepository('TriburchBackendJuegosBundle:Categoria')->find($_POST['joc_form']['categoria']);
            $joc->setCategoria($categoria);
            $errores = $this->get('validator')->validate($joc);

            if (count($errores)>0) {
                return $this->render('TriburchBackendJuegosBundle:Jocs:show.html.twig', array('form' => $form->createView(), 'errores' => $errores));
            }else{
                $em->persist($joc);
                $em->flush();
            }

            return $this->redirect($this->generateURL('joc_list'));

        }


        return $this->render('TriburchBackendJuegosBundle:Jocs:show.html.twig', array('form' => $form->createView()));




    }


    public function eraseAction($id){


        $em = $this->getDoctrine()->getManager();

        $joc = $em->getRepository('TriburchBackendJuegosBundle:Joc')->find($id);

        $em->remove($joc);
        $em->flush();

        return $this->redirect($this->generateURL('joc_list'));

    }


    public function listchildAction($id){

        $em = $this->getDoctrine()->getManager();
        $partidas=$em->getRepository('TriburchBackendJuegosBundle:Partida')->findBy(array('joc'=>$id));

        return $this->render('TriburchBackendJuegosBundle:Partidas:list.html.twig', array('partidas' => $partidas));


    }






}
