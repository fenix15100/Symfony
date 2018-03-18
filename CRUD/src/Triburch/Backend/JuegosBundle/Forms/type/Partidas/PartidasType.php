<?php
namespace Triburch\Backend\JuegosBundle\Forms\Type\Partidas;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class PartidasType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('quan','datetime',array('input'=>'datetime','widget'=>'choice'))
            ->add('temps')
            ->add('clicks')
            ->add('encerts')
            ->add('errades')
            ->add('dificultad')
            ->add('velocitat')
            ->add('so','checkbox',array('required'=>false))
            ->add('joc','entity',array('class'=> 'Triburch\Backend\JuegosBundle\Entity\Joc'))
            ->add('submit','submit',array('label'=>'Enviar'));

    }


    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(
            [
                'data_class' => 'Triburch\Backend\JuegosBundle\Entity\Partida',
            ]
        );
    }
    public function getName()
    {
        return 'partida_form';
    }

}