<?php

namespace App\Form;

use App\Entity\Employee;
use App\Entity\Role;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pseudo')
            ->add('email')
            ->add('password', PasswordType::class)
            ->add('firstName')
            ->add('lastName')
            ->add('phoneNumber')
            ->add('roles',  EntityType::class,

                [
                    //'query_builder' => function (RoleRepository $er) {
                    //    return $er->createQueryBuilder('u')
                    //        ->orderBy('u.label', 'ASC');
                    //},
                    'class' => Role::class,
                    'choice_label' => 'label',
                    'label' => 'Role à attribuer',
                    'multiple' => true,
                    'expanded' => true,
                ])
            ;


        //CollectionType::class, [

            //    'entry_type' => TextType::class,
//
            //    'entry_options' => [
            //       'attr' => ['class' => 'Role']
            //    ],
//
            //    //'class' => Role::class,
            //    //'choice_label' => 'name',
            //    //'label' => 'Attriubuer un rôle'

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
        ]);
    }
}
