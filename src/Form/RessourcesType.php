<?php

namespace App\Form;

use App\Entity\Documents;
use App\Entity\Ressources;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RessourcesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('url')
            ->add('type')
            ->add('title', TextType::class,
                ['label' => 'Nom de la référence']
            )
            ->add('documentId', EntityType::class ,[
                'class' => Documents::class,
                'choice_label' => 'titre',
                'label' => 'Titre de l\'oeuvre'
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ressources::class,
        ]);
    }
}
