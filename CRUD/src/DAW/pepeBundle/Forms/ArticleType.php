<?php
namespace DAW\pepeBundle\Forms;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title')
            ->add('author')
            ->add('created')
            ->add('content')
            ->add('tags')
            ->add('updated')
            ->add('slug')
            ->add('category');
    }
    public function getName()
    {
        return 'article_form';
    }
}