<?php

namespace App\Form;

use App\Entity\Asset;
use App\Entity\Aura;
use App\Entity\FireBlade;
use App\Entity\PlayerCharacter;
use App\Entity\Zodiac;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuraType extends MainType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var Aura $aura */
        $aura = $options['data'];

        $campaign = $this->userData->getCampaign();

        $builder
            ->add('sign', EntityType::class, [
                'class' => Zodiac::class,
                'label' => 'Signe',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
            ])
            ->add('breath', TextareaType::class, [
                'label' => 'Souffle',
            ])
            ->add('owners', EntityType::class, [
                'label' => 'Possédé par',
                'class' => PlayerCharacter::class,
                'choices' => $campaign->getCharacters(),
                'mapped' => false,
                'multiple' => true,
                'expanded' => false,
                'required' => false,
                'data' => $this->filter->getOwners( $aura ),
                'attr' => [
                    'data-select' => 'select2',
                ]
            ])
            ->add('viewers', EntityType::class, [
                'label' => 'Visible par',
                'class' => PlayerCharacter::class,
                'choices' => $campaign->getCharacters(),
                'mapped' => false,
                'multiple' => true,
                'expanded' => false,
                'required' => false,
                'data' => $this->filter->getViewers( $aura ),
                'attr' => [
                    'data-select' => 'select2',
                ]
            ])
            ->add( 'save', SubmitType::class, [
                'label' => 'Enregistrer',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Aura::class,
        ]);
    }
}
