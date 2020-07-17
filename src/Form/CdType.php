<?php

namespace App\Form;

use App\Entity\Cd;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CdType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cote')
            ->add('titre')
            ->add('format',  ChoiceType::class, [

                'choices'  => [ 'single',
                    'MP3',
                    'WAV',
                    'BWF',
                    'Ogg',


                ]])
            ->add('codeOeuvre')
            ->add('plages')
            ->add('duration')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cd::class,
        ]);
    }
}
