<?php

namespace App\Form;

use App\Entity\Ebook;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EbookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cote')
            ->add('titre')
            ->add('format', ChoiceType::class, [

                'choices'  => [
                    'carré'=>'carré',
                    'livre de poche'=>'livre de poche',
                    'grand format'=>'grand format',
                    'standard'=>'standard'
                ]])
            ->add('codeOeuvre')
            ->add('pages')
            ->add('img', FileType::class, [
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ebook::class,
        ]);
    }
}
