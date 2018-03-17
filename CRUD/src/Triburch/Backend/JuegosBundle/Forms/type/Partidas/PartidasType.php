<?php
namespace Triburch\Backend\JuegosBundle\Forms\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class PartidasType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('quan')
            ->add('temps')
            ->add('clicks')
            ->add('encerts')
            ->add('errades')
            ->add('dificultad')
            ->add('velocitat')
            ->add('so','checkbox')
            ->add('joc')
            ->add('submit','submit',array('label'=>'Enviar'));

    }
    public function getName()
    {
        return 'partida_form';
    }

}