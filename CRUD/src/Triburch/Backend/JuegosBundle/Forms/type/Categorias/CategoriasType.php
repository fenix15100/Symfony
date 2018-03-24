<?php
namespace Triburch\Backend\JuegosBundle\Forms\Type\Categorias;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class CategoriasType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom','text',array('label'=>'__name.show.Category'))
            ->add('treballa','text',array('label'=>'__work.show.Category'))
            ->add('submit','submit',array('label'=>'__submmit.show.Category'));

    }
    public function getName()
    {
        return 'categoria_form';
    }

}