<?php

namespace Triburch\Backend\JuegosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Triburch\Backend\JuegosBundle\Entity\Contact;
use Triburch\Backend\JuegosBundle\Forms\Type\Contact\ContactType;


use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;


class ContactController extends Controller
{
    public function newAction(){
        $request = $this->getRequest();
        $mailform = new Contact();
        $form = $this->createForm(new ContactType(),$mailform,array(
                'action' => $this->generateUrl('contact_new'),
                'method' => 'POST',
                'attr'=>array('id' => 'contact'))

        );
        if($request->getMethod() == 'POST')
        {

            $form->handleRequest($request);


            if($form->isValid())
            {
                $encoders = array(new XmlEncoder(), new JsonEncoder());
                $normalizers = array(new GetSetMethodNormalizer());
                $serializer = new Serializer($normalizers, $encoders);

                $mailform->setNombre($form['nombre']->getData());
                $mailform->setEmail($form['email']->getData());
                $mailform->setAsunto($form['asunto']->getData());
                $mailform->setMensaje($form['mensaje']->getData());



                try{
                    //smtp-mail.outlook.com va bien, para gmail hay que tener G-suite o tener una configuracion de seguridad mas relajada (Sin Doble Factor de autentificacion)
                    //Por eso a la gente no le hiba, porque tenian asociada la cuenta al movil
                    //https://castris.com/smtp-autenticado-con-gmail-para-programadores-swiftmailer-laravel-zend/
                    $host='smtp-mail.outlook.com';
                    $user='';
                    $secret='';
                    $transport = \Swift_SmtpTransport::newInstance()->setHost($host)
                        ->setEncryption('tls')
                        ->setPort(587)
                        ->setUsername($user)
                        ->setPassword($secret);

                    $mailer = \Swift_Mailer::newInstance($transport);
                    $mail = \Swift_Message::newInstance()
                        ->setSubject('Formulario de contacto de Swifmailer')
                        ->setFrom(array($transport->getUsername() =>'Fran Camacho'))
                        ->setTo($transport->getUsername())
                        ->setBody($this->renderView('TriburchBackendJuegosBundle:Contact:list.html.twig', array('mail' => $mailform,)), 'text/plain');

                    $mailer->send($mail);


                }catch (\Swift_TransportException $e){
                    return new Response("Fallo al enviar el correo <br/>".$e->getMessage());
                }


                return new Response('Correo enviado</br>'.$serializer->serialize($mailform,'json'),200);





            }
        }
        return $this->render('TriburchBackendJuegosBundle:Contact:show.html.twig', array('form' => $form->createView()));






    }


}
