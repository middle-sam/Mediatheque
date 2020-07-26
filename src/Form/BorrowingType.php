<?php

namespace App\Form;

use App\Entity\Borrowing;
use App\Entity\Documents;
use App\Entity\Member;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BorrowingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('startDate')
            ->add('expectedReturnDate')
            ->add('effectiveReturnDate')
            ->add('memberId', EntityType::class, [

                'class' => Member::class,
                'choice_label' => 'lastName',
                'label' => 'Nom de l\'adhérent'


            ])
            ->add('documentId', EntityType::class, [

                'class' => Documents::class,
                'choice_label' => 'titre',
                'label' => 'Nom de l\'oeuvre'

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Borrowing::class,
        ]);
    }
}
