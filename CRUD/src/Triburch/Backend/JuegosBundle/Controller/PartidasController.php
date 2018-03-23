<?php

namespace Triburch\Backend\JuegosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Triburch\Backend\JuegosBundle\Entity\Partida;
use Triburch\Backend\JuegosBundle\Forms\Type\Partidas\PartidasType;

class PartidasController extends Controller
{
    public function newAction()
    {
        $request = $this->getRequest();
        $partida = new Partida();
        $form = $this->createForm(new PartidasType(),$partida,array(
            'action' => $this->generateUrl('partida_new'),
            'method' => 'POST','attr'=>array('id' => 'contact')
        ));
        if($request->getMethod() == 'POST') {
            $em = $this->getDoctrine()->getManager();

            $year=$_POST['partida_form']['quan']['date']['year'];
            $month=$_POST['partida_form']['quan']['date']['month'];
            $day=$_POST['partida_form']['quan']['date']['day'];
            $hour=$_POST['partida_form']['quan']['time']['hour'];
            $minute=$_POST['partida_form']['quan']['time']['minute'];
            $quan=$year.'-'.$month.'-'.$day.' '.$hour.':'.$minute;
            $quan=\DateTime::createFromFormat('Y-m-d H:i', $quan);

            $partida->setQuan($quan);
            $partida->setTemps($_POST['partida_form']['temps']);
            $partida->setClicks($_POST['partida_form']['clicks']);
            $partida->setEncerts($_POST['partida_form']['encerts']);
            $partida->setErrades($_POST['partida_form']['errades']);
            $partida->setDificultad($_POST['partida_form']['dificultad']);
            $partida->setVelocitat($_POST['partida_form']['velocitat']);

            if(isset($_POST['partida_form']['so'])){
                $partida->setSo(true);
            }else{
                $partida->setSo(false);
            }

            $joc = $em->getRepository('TriburchBackendJuegosBundle:Joc')->find($_POST['partida_form']['joc']);
            $partida->setJoc($joc);
            $errores = $this->get('validator')->validate($partida);

            if (count($errores)>0) {
                return $this->render('TriburchBackendJuegosBundle:Partidas:show.html.twig', array('form' => $form->createView(), 'errores' => $errores));
            }else{
                $em->persist($partida);
                $em->flush();
            }

            return $this->redirect($this->generateURL('partida_list'));

        }
        return $this->render('TriburchBackendJuegosBundle:Partidas:show.html.twig', array('form' => $form->createView()));


    }


    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();

        $partidas = $em->getRepository('TriburchBackendJuegosBundle:Partida')->findAll();


        return $this->render('TriburchBackendJuegosBundle:Partidas:list.html.twig', array('partidas'=>$partidas));
    }


    public function editAction($id){
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $partida = $em->getRepository('TriburchBackendJuegosBundle:Partida')->find($id);
        $form = $this->createForm(new PartidasType(),$partida,array(
            'action' => $this->generateUrl('partida_edit',array('id'=>$id)),
            'method' => 'PUT',
            'attr'=>array('id' => 'contact')


        ));


        if($request->getMethod() == 'PUT') {
            $em = $this->getDoctrine()->getManager();

            $year=$_POST['partida_form']['quan']['date']['year'];
            $month=$_POST['partida_form']['quan']['date']['month'];
            $day=$_POST['partida_form']['quan']['date']['day'];
            $hour=$_POST['partida_form']['quan']['time']['hour'];
            $minute=$_POST['partida_form']['quan']['time']['minute'];
            $quan=$year.'-'.$month.'-'.$day.' '.$hour.':'.$minute;
            $quan=\DateTime::createFromFormat('Y-m-d H:i', $quan);

            $partida->setQuan($quan);
            $partida->setTemps($_POST['partida_form']['temps']);
            $partida->setClicks($_POST['partida_form']['clicks']);
            $partida->setEncerts($_POST['partida_form']['encerts']);
            $partida->setErrades($_POST['partida_form']['errades']);
            $partida->setDificultad($_POST['partida_form']['dificultad']);
            $partida->setVelocitat($_POST['partida_form']['velocitat']);

            if(isset($_POST['partida_form']['so'])){
                $partida->setSo(true);
            }else{
                $partida->setSo(false);
            }
            $joc = $em->getRepository('TriburchBackendJuegosBundle:Joc')->find($_POST['partida_form']['joc']);
            $partida->setJoc($joc);
            $errores = $this->get('validator')->validate($partida);

            if (count($errores)>0) {
                return $this->render('TriburchBackendJuegosBundle:Partidas:show.html.twig', array('form' => $form->createView(), 'errores' => $errores));
            }else{
                $em->persist($partida);
                $em->flush();
            }

            return $this->redirect($this->generateURL('partida_list'));

        }
        return $this->render('TriburchBackendJuegosBundle:Partidas:show.html.twig', array('form' => $form->createView()));


    }

    public function eraseAction($id){


        $em = $this->getDoctrine()->getManager();

        $partida= $em->getRepository('TriburchBackendJuegosBundle:Partida')->find($id);

        $em->remove($partida);
        $em->flush();

        return $this->redirect($this->generateURL('partida_list'));

    }


    public function listchildAction($id){

        $em = $this->getDoctrine()->getManager();
        $jugadors=$em->getRepository('TriburchBackendJuegosBundle:Jugador')->findBy(array('partida'=>$id));

        return $this->render('TriburchBackendJuegosBundle:Jugadors:list.html.twig', array('jugadors' => $jugadors));


    }

}
