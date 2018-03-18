<?php

namespace Triburch\Backend\JuegosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Triburch\Backend\JuegosBundle\Entity\Jugador;
use Triburch\Backend\JuegosBundle\Forms\Type\Jugadors\JugadorsType;

class JugadorsController extends Controller
{
    public function newAction()
    {
        $request = $this->getRequest();
        $jugador = new Jugador();
        $form = $this->createForm(new JugadorsType(),$jugador,array(
            'action' => $this->generateUrl('jugador_new'),
            'method' => 'POST'));
        if($request->getMethod() == 'POST') {
            $em = $this->getDoctrine()->getManager();

            $year=$_POST['jugador_form']['dataNaixement']['date']['year'];
            $month=$_POST['jugador_form']['dataNaixement']['date']['month'];
            $day=$_POST['jugador_form']['dataNaixement']['date']['day'];
            $data_naixement=$year.'-'.$month.'-'.$day;
            $data_naixement=\DateTime::createFromFormat('Y-m-d', $data_naixement);


            $jugador->setNom($_POST['jugador_form']['nom']);
            $jugador->setCognom1($_POST['jugador_form']['cognom1']);
            $jugador->setCognom2($_POST['jugador_form']['cognom2']);
            $jugador->setDataNaixement($data_naixement);
            $jugador->setDiagnostic($_POST['jugador_form']['diagnostic']);
            $jugador->setNick($_POST['jugador_form']['nick']);
            $jugador->setIdioma($_POST['jugador_form']['idioma']);

            if(isset($_POST['jugador_form']['actiu'])){
                $jugador->setActiu(true);
            }else{
                $jugador->setActiu(false);
            }
            $partida = $em->getRepository('TriburchBackendJuegosBundle:Partida')->find($_POST['jugador_form']['partida']);
            $jugador->setPartida($partida);
            $errores = $this->get('validator')->validate($jugador);

            if (count($errores)>0) {
                return $this->render('TriburchBackendJuegosBundle:Jugadors:show.html.twig', array('form' => $form->createView(), 'errores' => $errores));
            }else{
                $em->persist($jugador);
                $em->flush();
            }

            return $this->redirect($this->generateURL('jugador_list'));

        }
        return $this->render('TriburchBackendJuegosBundle:Jugadors:show.html.twig', array('form' => $form->createView()));


    }

    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();

        $jugadors = $em->getRepository('TriburchBackendJuegosBundle:Jugador')->findAll();


        return $this->render('TriburchBackendJuegosBundle:Jugadors:list.html.twig', array('jugadors'=>$jugadors));
    }


    public function editAction($id){
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $jugador = $em->getRepository('TriburchBackendJuegosBundle:Jugador')->find($id);
        $form = $this->createForm(new JugadorsType(),$jugador,array(
            'action' => $this->generateUrl('jugador_edit',array('id'=>$id)),
            'method' => 'PUT',
        ));

        if($request->getMethod() == 'PUT') {
            $em = $this->getDoctrine()->getManager();

            $year=$_POST['jugador_form']['dataNaixement']['date']['year'];
            $month=$_POST['jugador_form']['dataNaixement']['date']['month'];
            $day=$_POST['jugador_form']['dataNaixement']['date']['day'];
            $data_naixement=$year.'-'.$month.'-'.$day;
            $data_naixement=\DateTime::createFromFormat('Y-m-d', $data_naixement);


            $jugador->setNom($_POST['jugador_form']['nom']);
            $jugador->setCognom1($_POST['jugador_form']['cognom1']);
            $jugador->setCognom2($_POST['jugador_form']['cognom2']);
            $jugador->setDataNaixement($data_naixement);
            $jugador->setDiagnostic($_POST['jugador_form']['diagnostic']);
            $jugador->setNick($_POST['jugador_form']['nick']);
            $jugador->setIdioma($_POST['jugador_form']['idioma']);

            if(isset($_POST['jugador_form']['actiu'])){
                $jugador->setActiu(true);
            }else{
                $jugador->setActiu(false);
            }
            $partida = $em->getRepository('TriburchBackendJuegosBundle:Partida')->find($_POST['jugador_form']['partida']);
            $jugador->setPartida($partida);
            $errores = $this->get('validator')->validate($jugador);

            if (count($errores)>0) {
                return $this->render('TriburchBackendJuegosBundle:Jugadors:show.html.twig', array('form' => $form->createView(), 'errores' => $errores));
            }else{
                $em->persist($jugador);
                $em->flush();
            }

            return $this->redirect($this->generateURL('jugador_list'));

        }
        return $this->render('TriburchBackendJuegosBundle:Jugadors:show.html.twig', array('form' => $form->createView()));

    }

    public function eraseAction($id){


        $em = $this->getDoctrine()->getManager();

        $jugador= $em->getRepository('TriburchBackendJuegosBundle:Jugador')->find($id);

        $em->remove($jugador);
        $em->flush();

        return $this->redirect($this->generateURL('jugador_list'));

    }


}
