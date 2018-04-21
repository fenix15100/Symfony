<?php
/**
 * Created by PhpStorm.
 * User: franc
 * Date: 21/04/2018
 * Time: 22:17
 */

namespace Triburch\Backend\JuegosBundle\Forms\Type\Contact;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContactType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre','text',array('label'=>'Nombre'))
            ->add('email','text',array('label'=>'Email'))
            ->add('asunto','text',array('label'=>'Asunto'))
            ->add('mensaje','textarea',array('label'=>'Mensaje'))
            ->add('submit','submit',array('label'=>'Enviar'));
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Triburch\Backend\JuegosBundle\Entity\Contact'
        ));
    }

    public function getName()
    {
        return 'contact_form';
    }

}