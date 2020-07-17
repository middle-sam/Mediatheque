<?php

namespace App\Form;

use App\Entity\Creator;
use App\Entity\Documents;
use App\Entity\IsInvolvedIn;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IsInvolvedInType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('role', ChoiceType::class, [
                'choices'  => [
                    'Acteur : rôle principale' => 'acteur1',
                    'Acteur : Second rôle' => 'acteur2',
                    'Editeur' => 'éditeur',
                    'Réalisateur' => 'réalisateur',
                    'Scénariste' => 'scénariste',
                ],
            ])
            ->add('creatorId', EntityType::class, [
                'class' => Creator::class,
                'choice_label' => 'firstName',
                'label' => 'Nom de l\'invité'
            ])
            ->add('documentId',EntityType::class, [
                'class' => Documents::class,
                'choice_label' => 'titre',
                'label' => 'Nom de l\'oeuvre'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => IsInvolvedIn::class,
        ]);
    }
}
