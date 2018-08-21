<?php

namespace App\Form\Entities;

use App\Entity\Newspaper;
use App\Entity\Report;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class NewspaperType extends GenericType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var Newspaper $newspaper */
        $newspaper = $options['data'];

        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
            ])
            ->add('text', TextareaType::class, [
                'label' => 'Karma',
            ])
            ->add('imageFile', VichFileType::class, [
            'required' => false,
            'allow_delete' => true,
            'download_label' => 'newspaper',
            'download_uri' => true,
            //'image_uri' => true,
        ]);;

        parent::buildForm($builder, $options);

        $builder
            ->add( 'save', SubmitType::class, [
                'label' => 'Enregistrer',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Newspaper::class,
        ]);
    }
}
