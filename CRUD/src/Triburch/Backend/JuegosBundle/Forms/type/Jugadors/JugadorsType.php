<?php
namespace Triburch\Backend\JuegosBundle\Forms\Type\Jugadors;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class JugadorsType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom','text',array('label'=>'__name.show.Players'))
            ->add('cognom1','text',array('label'=>'__lastname1.show.Players'))
            ->add('cognom2','text',array('label'=>'__lastname2.show.Players'))
            ->add('dataNaixement','datetime',array('input'=>'datetime','widget'=>'choice','label'=>'__birth_date.show.Players'))
            ->add('diagnostic','textarea',array('label'=>'__diagnostic.show.Players'))
            ->add('nick','text',array('label'=>'__nick.show.Players'))
            ->add('idioma',null,array('label'=>'__idioma.show.Players'))
            ->add('actiu','checkbox',array('required'=>false,'label'=>'__active.show.Players'))
            ->add('partida','entity',array('class'=> 'Triburch\Backend\JuegosBundle\Entity\Partida','label'=>'__Partida.show.Players'))
            ->add('submit','submit',array('label'=>'__submmit.show.Players'));

    }
    public function getName()
    {
        return 'jugador_form';
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(
            array(
                'data_class' => 'Triburch\Backend\JuegosBundle\Entity\Jugador',
            )
        );
    }

}