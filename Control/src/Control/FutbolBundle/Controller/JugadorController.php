<?php

namespace Control\FutbolBundle\Controller;

use Control\FutbolBundle\Entity\Jugador;
use Control\FutbolBundle\Forms\Type\Jugador\JugadorType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

class JugadorController extends Controller
{


    public function newAction(){

        $request = $this->getRequest();
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        if($request->getRequestFormat()=='html'){

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

        }elseif ($request->getRequestFormat()==='json' and $request->getMethod()==='POST'){




            try{

                $jugador=$serializer->deserialize($request->getContent(),'Control\FutbolBundle\Entity\Jugador','json');
                $fecha=$jugador->getDataNaixement();
                $fecha=\DateTime::createFromFormat('Y-m-d',$fecha);
                $jugador->setDataNaixement($fecha);


                $em = $this->getDoctrine()->getManager();
                $em->persist($jugador);
                $em->flush();


                $response=new Response();
                $response->setContent($serializer->serialize($jugador=$this->toyears($jugador),'json'),200);

                return $response;
            }catch (\Exception $e) {
                return new JsonResponse([
                    'success' => false,
                    'code' => $e->getCode(),
                    'message' => $e->getMessage(),
                ], 500);

            }
        }elseif ($request->getRequestFormat()==='xml' and $request->getMethod()==='POST'){


            try{

                $jugador=$serializer->deserialize($request->getContent(),'Control\FutbolBundle\Entity\Jugador','xml');
                $fecha=$jugador->getDataNaixement();
                $fecha=\DateTime::createFromFormat('Y-m-d',$fecha);
                $jugador->setDataNaixement($fecha);


                $em = $this->getDoctrine()->getManager();
                $em->persist($jugador);
                $em->flush();

                $response=new Response();
                $response->setContent($serializer->serialize($jugador=$this->toyears($jugador),'xml'),200);

                return $response;
            }catch (\Exception $e) {

                $response=new Response();
                $response->setContent('<?xml version="1.0"?><response><succes>false</succes><code>'.$e->getCode().'</code><message>'.$e->getMessage().'</message></response>',500);
                return $response;
            }


        } else{
            return new JsonResponse([
                'success' => false,
                'code' => '500',
                'message' => 'Malformed HTTP Request',
            ], 500);
        }



    }


    public function showallAction()
    {

        $request = $this->getRequest();
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $em = $this->getDoctrine()->getManager();

        $jugadores = $em->getRepository('ControlFutbolBundle:Jugador')->findAll();
        $jugadores=$this->toyears($jugadores);

        if($request->getMethod()==='GET' and $request->getRequestFormat()==='html'){

            return $this->render('ControlFutbolBundle:Jugador:list.html.twig', array('jugadores'=>$jugadores));

        }elseif ($request->getMethod()==='GET' and $request->getRequestFormat()==='json') {


            try {

                $reponse = new Response();
                $reponse->setContent($serializer->serialize($jugadores, 'json'), 200);

            } catch (\Exception $e) {

                return new JsonResponse([
                    'success' => false,
                    'code' => $e->getCode(),
                    'message' => $e->getMessage(),
                ], 500);

            }
            return $reponse;

        }elseif ($request->getMethod()==='GET' and $request->getRequestFormat()==='xml'){
           try{
               $response=new Response();
               $response->setContent($serializer->serialize($jugadores,'xml'),200);
               return $response;

           }catch (\Exception $e){

               $response=new Response();
               $response->setContent('<?xml version="1.0"?><response><succes>false</succes><code>'.$e->getCode().'</code><message>'.$e->getMessage().'</message></response>',500);
               return $response;
           }

        }else{
            return new JsonResponse([
                'success' => false,
                'code' => '500',
                'message' => 'Malformed HTTP Request',
            ], 500);
        }


    }

    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $jugador = $em->getRepository('ControlFutbolBundle:Jugador')->find($id);

        return $this->render('ControlFutbolBundle:Jugador:show.html.twig', array('jugador'=>$jugador));

    }

    private function toyears($jugadores)
    {
        if(is_array($jugadores)){
            foreach ($jugadores as  $j ){

                $cumpleanos = $j->getDataNaixement();
                $now = new \DateTime();
                $edad = $now->diff($cumpleanos);
                $j->setDataNaixement($edad->y);
            }

            return$jugadores;

        }else{
            $cumpleanos = $jugadores->getDataNaixement();
            $now = new \DateTime();
            $edad = $now->diff($cumpleanos);
            $jugadores->setDataNaixement($edad->y);

            return $jugadores;
        }


    }




}
