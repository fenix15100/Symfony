<?php

namespace DAW\pepeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DAW\pepeBundle\Entity\Alumne;
use DAW\pepeBundle\Forms\Type\AlumneType;

class AlumnesController extends Controller
{
    public function newAction()
    {
        $request = $this->getRequest();
        $alumne = new Alumne();
        $form = $this->createForm(new AlumneType(),$alumne);


        if($request->getMethod() == 'POST')
        {

            $form->handleRequest($request);


            if($form->isValid())
            {

                $em = $this->getDoctrine()->getManager();
                $em->persist($alumne);
                $em->flush();

                return $this->redirect($this->generateURL('alumne_list'));
            }
        }


        return $this->render('DAWpepeBundle:Alumnes:new.html.twig', array('form' => $form->createView()));
    }

    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();

        $alumnes = $em->getRepository('DAWpepeBundle:Alumne')->findAll();


        return $this->render('DAWpepeBundle:Alumnes:list.html.twig', array('alumnes'=>$alumnes));
    }


}
