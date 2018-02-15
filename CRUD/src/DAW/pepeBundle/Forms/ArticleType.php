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
            ->add('created');
    }
    public function getName()
    {
        return 'article_form';
    }
}