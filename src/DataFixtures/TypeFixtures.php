<?php
// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $type = new Type();
        $type->setLabel("question libre");
        $manager->persist($type);

        $type = new Type();
        $type->setLabel("question libre");
        $manager->persist($type);

        $type = new Type();
        $type->setLabel("question à choix");
        $manager->persist($type);

        $type = new Type();
        $type->setLabel("vrai/faux");
        $manager->persist($type);

        $manager->flush();
    }
}