<?php
namespace Triburch\Backend\JuegosBundle\Forms\Type\Jocs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class JocsType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')
            ->add('imatge')
            ->add('categoria','entity',array('class'=> 'Triburch\Backend\JuegosBundle\Entity\Categoria'))
            ->add('submit','submit',array('label'=>'Enviar'));

    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(
            [
                'data_class' => 'Triburch\Backend\JuegosBundle\Entity\Joc',
            ]
        );
    }
    public function getName()
    {
        return 'joc_form';
    }

}