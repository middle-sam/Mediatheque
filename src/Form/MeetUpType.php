<?php

namespace App\Form;

use App\Entity\Creator;
use App\Entity\Employee;
use App\Entity\MeetUp;
use App\Entity\User;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MeetUpType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date')
            ->add('employeeId', EntityType::class, [
                // looks for choices from this entity
                'class' => Employee::class,
                // uses the User.username property as the visible option string
                'choice_label' => 'firstName',

                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ])
            ->add('creatorId', EntityType::class, [
                'class' => Creator::class,
                'choice_label' => 'firstName',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MeetUp::class,
        ]);
    }
}
