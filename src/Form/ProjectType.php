<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array('label' => 'Titre'))
            ->add('description', TextareaType::class, array('label' => 'Description du project'))
            ->add('logo', FileType::class, array('label' => 'Vinette'))
            ->add('website', TextType::class, array('label' => 'Site Web', 'required' => false))
            ->add('github', TextType::class, array('label' => 'Github', 'required' => false))
            ->add('gitlab', TextType::class, array('label' => 'Gitlab', 'required' => false))
            ->add('create', SubmitType::class, array('label' => 'Ajouter le projet'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
