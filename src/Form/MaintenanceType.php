<?php

namespace App\Form;

use App\Entity\Documents;
use App\Entity\Employee;
use App\Entity\Maintenance;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MaintenanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('maintenanceDate')
            ->add('status')
            ->add('creator')
            ->add('employeeId',  EntityType::class, [

                'class' => Employee::class,
                'choice_label' => 'firstName',

            ])
            ->add('documentId', EntityType::class, [

                'class' => Documents::class,
                'choice_label' => 'titre',

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Maintenance::class,
        ]);
    }
}
