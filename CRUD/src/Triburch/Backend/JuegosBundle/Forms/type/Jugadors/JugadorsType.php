<?php
namespace Triburch\Backend\JuegosBundle\Forms\Type\Jugadors;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class JugadorsType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')
            ->add('cognom1')
            ->add('cognom2')
            ->add('dataNaixement','datetime',array('input'=>'datetime','widget'=>'choice'))
            ->add('diagnostic')
            ->add('nick')
            ->add('idioma')
            ->add('actiu','checkbox',array('required'=>false))
            ->add('partida')
            ->add('submit','submit',array('label'=>'Enviar'));

    }
    public function getName()
    {
        return 'jugador_form';
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(
            [
                'data_class' => 'Triburch\Backend\JuegosBundle\Entity\Jugador',
            ]
        );
    }

}