<?php

namespace Triburch\Backend\JuegosBundle\Forms\Type\Empresas;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EmpresaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('idioma')
            ->add('descripcio')
            ->add('correu')
            ->add('adresa')
            ->add('cp')
            ->add('poblacio')
            ->add('submit','submit',array('label'=>'Enviar'));
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Triburch\Backend\JuegosBundle\Entity\Empresa'
        ));
    }

    public function getName()
    {
        return 'empresa_form';
    }
}
