<?php
namespace Triburch\Backend\JuegosBundle\Forms\Type\Partidas;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class PartidasType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('quan','datetime',array('input'=>'datetime','widget'=>'choice','label'=>'__when.show.Partida'))
            ->add('temps',null,array('label'=>'__time.show.Partida'))
            ->add('clicks',null,array('label'=>'__clics.show.Partida'))
            ->add('encerts',null,array('label'=>'__success.show.Partida'))
            ->add('errades',null,array('label'=>'__fail.show.Partida'))
            ->add('dificultad',null,array('label'=>'__difficulty.show.Partida'))
            ->add('velocitat',null,array('label'=>'__velocity.show.Partida'))
            ->add('so','checkbox',array('required'=>false))
            ->add('joc','entity',array('class'=> 'Triburch\Backend\JuegosBundle\Entity\Joc','label'=>'__Game.show.Partida'))
            ->add('submit','submit',array('label'=>'__submmit.show.Partida'));

    }


    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(
            array(
                'data_class' => 'Triburch\Backend\JuegosBundle\Entity\Partida',
            )
        );
    }
    public function getName()
    {
        return 'partida_form';
    }

}