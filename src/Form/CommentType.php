<?php

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var CommentType $comment */
        $comment = $options['data'];


        $builder
            ->add('dateGame', DateType::class, [
                'label' => 'Date',
            ])
            ->add('text', TextareaType::class, [
                'label' => 'Texte',
            ]);

        $builder
            ->add( 'save', SubmitType::class, [
                'label' => 'Enregistrer',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
