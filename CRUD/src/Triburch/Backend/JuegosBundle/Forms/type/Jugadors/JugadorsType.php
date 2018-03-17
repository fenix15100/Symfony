<?php
namespace Triburch\Backend\JuegosBundle\Forms\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class JugadorsType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')
            ->add('cognom1')
            ->add('cognom2')
            ->add('dataNaixement')
            ->add('diagnostic')
            ->add('nick')
            ->add('idioma')
            ->add('actiu','checkbox')
            ->add('partida')
            ->add('submit','submit',array('label'=>'Enviar'));

    }
    public function getName()
    {
        return 'jugador_form';
    }

}