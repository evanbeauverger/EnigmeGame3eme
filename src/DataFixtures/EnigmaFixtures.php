<?php

namespace App\DataFixtures;

use App\Entity\Enigma;
use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EnigmaFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        // On indique que cette fixture dépend de TypeFixtures
        return [
            TypeFixtures::class,
        ];
    }

    public function load(ObjectManager $manager): void
    {
        $enigma = new Enigma();
        $enigma->setType($this->getReference('question_libre', Type::class));
        $enigma->setOrder(1);
        $enigma->setTitle("Enigme 1 sur l'IA");
        $enigma->setInstruction("Quelle société a créé ChatGPT ?");
        $enigma->setSecretCode("openai");
        $manager->persist($enigma);

        $enigma = new Enigma();
        $enigma->setType($this->getReference('question_à_choix', Type::class));
        $enigma->setOrder(2);
        $enigma->setTitle("Enigme 2 sur l'IA");
        $enigma->setInstruction("Quelle est l'IA de Google ?");
        $enigma->setOptionA("ChatGPT");
        $enigma->setOptionB("Grok");
        $enigma->setOptionC("Claude");
        $enigma->setOptionD("Gemini");
        $enigma->setSecretCode("Gemini");
        $manager->persist($enigma);

        $enigma = new Enigma();
        $enigma->setType($this->getReference('vrai/faux', Type::class));
        $enigma->setOrder(3);
        $enigma->setTitle("Enigme 3 sur l'IA");
        $enigma->setInstruction("L'IA a toujours raison");
        $enigma->setSecretCode("faux");
        $manager->persist($enigma);

        $manager->flush();
    }
}