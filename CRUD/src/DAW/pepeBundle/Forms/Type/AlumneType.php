<?php
namespace DAW\pepeBundle\Forms\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
/**
 * Created by PhpStorm.
 * User: fenix
 * Date: 26/02/2018
 * Time: 14:59
 */
class AlumneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')
            ->add('observacions')
            ->add('dataNaixement')
            ->add('edat')
            ->add('majorEdat','checkbox',array('required'=>false))
            ->add('notaMitja')
            ->add('dataMatriculacion')
            ->add('submit','submit',array('label'=>'Enviar'));

    }
    public function getName()
    {
        return 'alumne_form';
    }

}