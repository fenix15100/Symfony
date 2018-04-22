<?php
/**
 * Created by PhpStorm.
 * User: franc
 * Date: 22/04/2018
 * Time: 2:07
 */
namespace Control\FutbolBundle\Forms\Type\Jugador;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class JugadorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom','text',array('label'=>'__nombre.show.Jugador'))
            ->add('equip','text',array('label'=>'__equipo.show.Jugador'))
            ->add('gols','integer',array('label'=>'__goles.show.Jugador'))
            ->add('dataNaixement','birthday',array('label'=>'__date_nacimiento.show.Jugador'))
            ->add('submit','submit',array('label'=>'__enviar.show.Jugador'));
        ;
    }



    public function getName()
    {
        return 'jugador_form';
    }




}