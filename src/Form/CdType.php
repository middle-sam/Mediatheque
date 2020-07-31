<?php

namespace App\Form;

use App\Entity\Cd;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
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

                'choices'  => [
                    'MP3'=>'MP3',
                    'WAV'=>'WAV',
                    'BWF'=>'BWF',
                    'Ogg'=>'Ogg',
                    'AIFF'=>'AIFF',
                    'mp3PRO'=>'mp3PRO',
                    'CAF'=>'CAF',
                    'RAW'=>'RAW',

                ]])
            ->add('codeOeuvre')
            ->add('plages')
            ->add('duration')
            ->add('img', FileType::class, [
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cd::class,
        ]);
    }
}
