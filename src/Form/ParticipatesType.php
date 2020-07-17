<?php

namespace App\Form;

use App\Entity\MeetUp;
use App\Entity\Member;
use App\Entity\Participates;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParticipatesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('places')
            ->add('userId', EntityType::class, [

                'class' => User::class,
                'choice_label' => 'firstName'

            ])
            ->add('meetUpId', EntityType::class, [

                'class' => MeetUp::class,
                'choice_label' => 'id'

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Participates::class,
        ]);
    }
}
