<?php

namespace App\Form;

use App\Entity\Enigma;
use App\Entity\Thumbnail;
use App\Entity\Type;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnigmaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $typeId = $options['type_id'];

        $builder
            ->add('title', null, [
                'label' => 'Titre : ',
            ])
            ->add('instruction', null, [
                'label' => 'Instruction : ',
            ])
            ->add('thumbnail', EntityType::class, [
                'class' => Thumbnail::class,
                'choice_label' => 'image',
                'multiple' => true,
                'label' => 'Image : ',
            ])
            ->add('order_', null, [
                'label' => 'N° de l\'énigme : ',
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'email',
                'multiple' => true,
                'label' => 'Fait par : ',
            ]);

        if ($typeId) {
        switch ($typeId) {
            case 1: // Question libre
                $builder->add('secretcode', null, [
                    'label' => 'Réponse libre',
                ]);
                break;

            case 2: // Question à choix
                $builder
                    ->add('optionA', null, ['label' => 'Option A'])
                    ->add('optionB', null, ['label' => 'Option B'])
                    ->add('optionC', null, ['label' => 'Option C'])
                    ->add('optionD', null, ['label' => 'Option D'])
                    ->add('secretcode', null, ['label' => 'Bonne réponse (A/B/C/D)']);
                break;

            case 3: // Vrai/Faux
                $builder->add('secretcode', ChoiceType::class, [
                    'label' => 'Réponse',
                    'choices' => [
                        'Vrai' => 'Vrai',
                        'Faux' => 'Faux'
                    ],
                    'expanded' => true,
                    'multiple' => false,
                ]);
                break;
        }
    }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
        'data_class' => Enigma::class,
        'type_id' => null,
        ]);
    }
}
