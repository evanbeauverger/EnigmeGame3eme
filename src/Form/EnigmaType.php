<?php

namespace App\Form;

use App\Entity\Enigma;
use App\Entity\Game;
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
            ->add('title')
            ->add('type', EntityType::class, [
                'class' => Type::class,
                'choice_label' => 'label',
            ])
            ->add('instruction')
            ->add('thumbnail', EntityType::class, [
                'class' => Thumbnail::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('order_')
            ->add('secretcode')
            ->add('game', EntityType::class, [
                'class' => Game::class,
                'choice_label' => 'title',
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'email',
                'multiple' => true,
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
