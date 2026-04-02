<?php

namespace App\Form;

use App\Entity\Enigma;
use App\Entity\Thumbnail;
use App\Entity\Type;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnigmaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'label' => 'Titre : ', ])
            ->add('type', EntityType::class, [
                'class' => Type::class,
                'choice_label' => 'label',
                'label' => 'Type : ',
            ])
            ->add('instruction', null, [
                'label' => 'Instruction : ', ])
            ->add('thumbnail', EntityType::class, [
                'class' => Thumbnail::class,
                'choice_label' => 'image',
                'multiple' => true,
                'label' => 'Image : ',
            ])
            ->add('order_', null, [
                'label' => 'N° de l\'énigme : ', ])
            ->add('secretcode', null, [
                'label' => 'Réponse : ', ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'email',
                'multiple' => true,
                'label' => 'Fait par : ',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Enigma::class,
        ]);
    }
}
