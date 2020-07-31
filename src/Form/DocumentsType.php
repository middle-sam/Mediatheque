<?php

namespace App\Form;

use App\Entity\Documents;
use phpDocumentor\Reflection\Types\False_;
use Symfony\Component\Form\AbstractType;


use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DocumentsType extends AbstractType
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
            ->add('img', FileType::class, [
                 'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Documents::class,
        ]);
    }
}
