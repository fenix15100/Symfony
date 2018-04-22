<?php

namespace Control\FutbolBundle\Controller;

use Control\FutbolBundle\Entity\Jugador;
use Control\FutbolBundle\Forms\Type\Jugador\JugadorType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class JugadorController extends Controller
{


    public function newAction(){

        $request = $this->getRequest();
        $jugador = new Jugador();
        $form = $this->createForm(new JugadorType(),$jugador,array(
                'action' => $this->generateUrl('control_futbol_new'),
                'method' => 'POST',
                'attr'=>array('id' => 'contact'))

        );
        if($request->getMethod() == 'POST')
        {

            $form->handleRequest($request);


            if($form->isValid())
            {

                $em = $this->getDoctrine()->getManager();
                $em->persist($jugador);
                $em->flush();

                return $this->redirect($this->generateURL('control_futbol_showall'));
            }
        }
        return $this->render('ControlFutbolBundle:Jugador:form.html.twig', array('form' => $form->createView()));


    }


    public function showallAction()
    {
        $em = $this->getDoctrine()->getManager();

        $jugadores = $em->getRepository('ControlFutbolBundle:Jugador')->findAll();

        return $this->render('ControlFutbolBundle:Jugador:list.html.twig', array('jugadores'=>$jugadores));

    }

    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $jugador = $em->getRepository('ControlFutbolBundle:Jugador')->find($id);

        return $this->render('ControlFutbolBundle:Jugador:show.html.twig', array('jugador'=>$jugador));

    }


    private function outputFormat($id=null,$format,$action){

        if($action==='new'){
            switch ($format){
                case 'html':







                    break;


            }

        }



    }
}
