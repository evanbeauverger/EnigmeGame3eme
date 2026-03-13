<?php
// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\Enigma;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EnigmaFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $enigma = new Enigma();
        $enigma->setType_id(1);
        $enigma->setOrder_(1);
        $enigma->setTitle("Enigme 1 sur l'IA");
        $enigma->setInstruction("Quelle société a créer ChatGPT ?");
        $enigma->setSecretCode("openai");
        $manager->persist($enigma);

        $manager->flush();
    }
}