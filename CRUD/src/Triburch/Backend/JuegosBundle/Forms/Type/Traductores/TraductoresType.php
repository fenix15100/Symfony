<?php
namespace Triburch\Backend\JuegosBundle\Forms\Type\Traductores;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class TraductoresType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('es','text',array('label'=>'Traducion Español','required'=>false))
            ->add('ca','text',array('label'=>'Traduccio Catala','required'=>false))
            ->add('fr','text',array('label'=>'Traduccio Frances','required'=>false))
            ->add('en','text',array('label'=>'Traduccio Ingles','required'=>false))
            ->add('submit','submit',array('label'=>'Enviar'));

    }
    public function getName()
    {
        return 'traductor_form';
    }

}