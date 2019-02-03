<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array('label' => 'Titre'))
            ->add('vignette', FileType::class, array('label' => 'Vinette'))
            ->add('url', TextType::class, array('label' => 'Route'))
            ->add('epigraph', TextType::class, array('label' => 'Epigraphe', 'required' => false))
            ->add('content', TextareaType::class, array('label' => 'Contenu de l`\'article'))
            ->add('blog', CheckboxType::class, array('label' => 'Publier dans \'Articles\' ?', 'required' => false))
            ->add('tutorial', CheckboxType::class, array('label' => 'Publier dans \'Tutoriels\' ?', 'required' => false))
            ->add('publish', SubmitType::class, array('label' => 'Valider'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
