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
                $response->setContent($serializer->serialize($jugador=$this->toyears($jugador),'json'),201);

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
                $response->setContent($serializer->serialize($jugador=$this->toyears($jugador),'xml'),201);

                return $response;
            }catch (\Exception $e) {

                $response=new Response();
                $response->setContent('<?xml version="1.0"?><response><succes>false</succes><code>'.$e->getCode().'</code><message>'.$e->getMessage().'</message></response>',500);
                return $response;
            }


        } else{

            if($request->getRequestFormat()==='json'){
                return new JsonResponse([
                    'success' => false,
                    'code' => '400',
                    'message' => 'Malformed HTTP Request',
                ], 400);
            }else{
                $response=new Response();
                $response->setContent('<?xml version="1.0"?><response><succes>false</succes><code>400</code><message>Malformed HTTP Request</message></response>',400);
                return $response;
            }

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
                $reponse->setContent($serializer->serialize($jugadores,'json'), 200);

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
            if($request->getRequestFormat()==='json'){
                return new JsonResponse([
                    'success' => false,
                    'code' => '400',
                    'message' => 'Malformed HTTP Request',
                ], 400);
            }else{
                return new Response('<?xml version="1.0"?><response><succes>false</succes><code>400</code><message>Malformed HTTP Request</message></response>',400);

            }
        }


    }

    public function showAction($id)
    {
        $request = $this->getRequest();
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $em = $this->getDoctrine()->getManager();
        $jugador = $em->getRepository('ControlFutbolBundle:Jugador')->find($id);

        if($request->getMethod()==='GET' and $request->getRequestFormat()==='html'){

            if($jugador===null){
                return new Response('ERROR 404 Jugador '.$id.' No encontrado',404);
            }
            return $this->render('ControlFutbolBundle:Jugador:show.html.twig', array('jugador'=>$jugador));

        }elseif ($request->getMethod()==='GET' and $request->getRequestFormat()==='json'){

            try{
                if($jugador===null){
                    return new JsonResponse([
                        'success' => false,
                        'code' => 404,
                        'message' => 'No se ha encontrado el jugador '.$id,
                    ], 404);
                }
                $response=new Response();
                $response->setContent($serializer->serialize($jugador=$this->toyears($jugador),'json'),200);
            }catch (\Exception $e){
                return new JsonResponse([
                    'success' => false,
                    'code' => $e->getCode(),
                    'message' => $e->getMessage(),
                ], 500);

            }

            return $response;



        }elseif ($request->getMethod()==='GET' and $request->getRequestFormat()==='xml'){

            try{
                if($jugador===null){
                    return new Response('<?xml version="1.0"?><response><succes>false</succes><code>404</code><message>No se ha encontrado el registro '.$id.'</message></response>',404);
                }
                $response=new Response();
                $response->setContent($serializer->serialize($jugador=$this->toyears($jugador),'xml'),200);
            }catch (\Exception $e){
                $response=new Response();
                $response->setContent('<?xml version="1.0"?><response><succes>false</succes><code>'.$e->getCode().'</code><message>'.$e->getMessage().'</message></response>',500);
                return $response;
            }
            return $response;

        }else{
            if($request->getRequestFormat()==='json'){
                return new JsonResponse([
                    'success' => false,
                    'code' => '400',
                    'message' => 'Malformed HTTP Request',
                ], 400);
            }else{
                return new Response('<?xml version="1.0"?><response><succes>false</succes><code>400</code><message>Malformed HTTP Request</message></response>',400);

            }

        }


    }

    public function eraseAction($id){

        $request = $this->getRequest();
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $em = $this->getDoctrine()->getManager();
        $jugador = $em->getRepository('ControlFutbolBundle:Jugador')->find($id);

        if($request->getMethod()==='DELETE' and $request->getRequestFormat()==='html'){
            if($jugador===null){
                return new Response('ERROR 404 Jugador '.$id.' No encontrado no se ha podido borrar',404);

            }
            $em->remove($jugador);
            $em->flush();
            return $this->redirect($this->generateURL('control_futbol_showall'));
        }elseif ($request->getMethod()==='DELETE' and $request->getRequestFormat()==='json'){

            try{
                if($jugador===null){
                    return new JsonResponse([
                        'success' => false,
                        'code' => 404,
                        'message' => 'No se ha encontrado el jugador '.$id.' No se ha podido Borrar',
                    ], 404);
                }
                $em->remove($jugador);
                $em->flush();
                $response=new Response();
                $response->setContent($serializer->serialize($jugador=$this->toyears($jugador),'json'),201);
            }catch (\Exception $e){
                return new JsonResponse([
                    'success' => false,
                    'code' => $e->getCode(),
                    'message' => $e->getMessage(),
                ], 500);

            }

            return $response;

        }elseif ($request->getMethod()==='DELETE' and $request->getRequestFormat()==='xml'){

            try{
                if($jugador===null){
                    return new Response('<?xml version="1.0"?><response><succes>false</succes><code>404</code><message>No se ha encontrado el registro '.$id.' No se ha borrado nada</message></response>',404);
                }
                $em->remove($jugador);
                $em->flush();
                $response=new Response();
                $response->setContent($serializer->serialize($jugador=$this->toyears($jugador),'xml'),201);
            }catch (\Exception $e){
                $response=new Response();
                $response->setContent('<?xml version="1.0"?><response><succes>false</succes><code>'.$e->getCode().'</code><message>'.$e->getMessage().'</message></response>',500);
                return $response;


            }

            return $response;



        }else{

            if($request->getRequestFormat()==='json'){
                return new JsonResponse([
                    'success' => false,
                    'code' => '400',
                    'message' => 'Malformed HTTP Request',
                ], 400);
            }else{
                return new Response('<?xml version="1.0"?><response><succes>false</succes><code>400</code><message>Malformed HTTP Request</message></response>',400);

            }


        }


    }


    public function editAction($id){
        $request = $this->getRequest();
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $em = $this->getDoctrine()->getManager();
        $jugador = $em->getRepository('ControlFutbolBundle:Jugador')->find($id);

        if($request->getRequestFormat()==='html'){
            if($jugador===null){
                return new Response('ERROR 404 Jugador '.$id.' No encontrado no se ha editado',404);

            }

            $form = $this->createForm(new JugadorType(),$jugador,array(
                'action' => $this->generateUrl('control_futbol_edit',array('id'=>$id)),
                'method' => 'PUT',
                'attr'=>array('id' => 'contact')


            ));

            if($request->getMethod() == 'PUT')
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



        }elseif ($request->getMethod()==='PUT' and $request->getRequestFormat()==='json'){

            try{
                if($jugador===null){
                    return new JsonResponse([
                        'success' => false,
                        'code' => 404,
                        'message' => 'No se ha encontrado el jugador '.$id.' No se ha podido Editar',
                    ], 404);
                }

                $jugadorjson=$serializer->deserialize($request->getContent(),'Control\FutbolBundle\Entity\Jugador','json');

                $fecha=$jugadorjson->getDataNaixement();
                $fecha=\DateTime::createFromFormat('Y-m-d',$fecha);
                $jugadorjson->setDataNaixement($fecha);


                $jugador->setNom($jugadorjson->getNom());
                $jugador->setEquip($jugadorjson->getEquip());
                $jugador->setGols($jugadorjson->getGols());
                $jugador->setDataNaixement($jugadorjson->getDataNaixement());

                $em->persist($jugador);
                $em->flush();

                $response=new Response();
                $response->setContent($serializer->serialize($jugador=$this->toyears($jugador),'json'),201);
            }catch (\Exception $e){
                return new JsonResponse([
                    'success' => false,
                    'code' => $e->getCode(),
                    'message' => $e->getMessage(),
                ], 500);

            }

            return $response;



        }elseif ($request->getMethod()==='PUT' and $request->getRequestFormat()==='xml'){



            try{
                if($jugador===null){
                    return new Response('<?xml version="1.0"?><response><succes>false</succes><code>404</code><message>No se ha encontrado el registro '.$id.'No se ha puede editar</message></response>',404);
                }

                $jugadorjson=$serializer->deserialize($request->getContent(),'Control\FutbolBundle\Entity\Jugador','xml');

                $fecha=$jugadorjson->getDataNaixement();
                $fecha=\DateTime::createFromFormat('Y-m-d',$fecha);
                $jugadorjson->setDataNaixement($fecha);


                $jugador->setNom($jugadorjson->getNom());
                $jugador->setEquip($jugadorjson->getEquip());
                $jugador->setGols($jugadorjson->getGols());
                $jugador->setDataNaixement($jugadorjson->getDataNaixement());

                $em->persist($jugador);
                $em->flush();

                $response=new Response();
                $response->setContent($serializer->serialize($jugador=$this->toyears($jugador),'xml'),201);
            }catch (\Exception $e){
                $response=new Response();
                $response->setContent('<?xml version="1.0"?><response><succes>false</succes><code>'.$e->getCode().'</code><message>'.$e->getMessage().'</message></response>',500);
                return $response;

            }

            return $response;

        }else{
            if($request->getRequestFormat()==='json'){
                return new JsonResponse([
                    'success' => false,
                    'code' => '400',
                    'message' => 'Malformed HTTP Request',
                ], 400);
            }else{
                return new Response('<?xml version="1.0"?><response><succes>false</succes><code>400</code><message>Malformed HTTP Request</message></response>',400);

            }

        }


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
