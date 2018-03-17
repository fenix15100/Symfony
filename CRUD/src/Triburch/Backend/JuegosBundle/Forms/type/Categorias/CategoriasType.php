<?php
namespace Triburch\Backend\JuegosBundle\Forms\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class CategoriasType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')
            ->add('treballa')
            ->add('submit','submit',array('label'=>'Enviar'));

    }
    public function getName()
    {
        return 'categoria_form';
    }

}