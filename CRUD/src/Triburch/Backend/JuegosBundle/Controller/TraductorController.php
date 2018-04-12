<?php

namespace Triburch\Backend\JuegosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Triburch\Backend\JuegosBundle\Entity\Traductor;
use Triburch\Backend\JuegosBundle\Forms\Type\Traductores\TraductoresType;

class TraductorController extends Controller
{



    public function newAction($id)
    {   $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();

        $joc=$em->getRepository('TriburchBackendJuegosBundle:Joc')->find($id);

        $traductor = new Traductor();
        if(count($joc->getArrayTrans())>0){
            $array=$joc->getArrayTrans();
            $traductor->setEs($array['es_ES']);
            $traductor->setCa($array['ca']);
            $traductor->setEn($array['en']);
            $traductor->setFr($array['fr']);
        }



        $form = $this->createForm(new TraductoresType(),$traductor,array(
                'action' => $this->generateUrl('traductor_new',array('id'=>$id)),
                'method' => 'POST',
                'attr'=>array('id' => 'contact'))

        );
        if($request->getMethod() == 'POST')
        {

            $form->handleRequest($request);


            if($form->isValid())
            {


                $joc = $em->getRepository('TriburchBackendJuegosBundle:Joc')->find($id);
                $joc->setArrayTrans($traductor);
                $em->persist($joc);
                $em->flush();

                return $this->redirect($this->generateURL('joc_list'));
            }
        }
        return $this->render('TriburchBackendJuegosBundle:Traductores:show.html.twig', array('form' => $form->createView()));


    }
}
