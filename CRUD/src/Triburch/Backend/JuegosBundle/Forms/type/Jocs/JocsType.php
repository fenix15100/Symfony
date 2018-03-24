<?php
namespace Triburch\Backend\JuegosBundle\Forms\Type\Jocs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class JocsType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom','text',array('label'=>'__name.show.Games'))
            ->add('imatge','text',array('label'=>'__image.show.Games'))
            ->add('categoria','entity',array('class'=> 'Triburch\Backend\JuegosBundle\Entity\Categoria','label'=>'__category.show.Games'))
            ->add('submit','submit',array('label'=>'__submmit.show.Games'));

    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(
            array(
                'data_class' => 'Triburch\Backend\JuegosBundle\Entity\Joc',
            )
        );
    }
    public function getName()
    {
        return 'joc_form';
    }

}