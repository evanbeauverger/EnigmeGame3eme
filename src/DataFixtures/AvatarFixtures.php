<?php
// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\Avatar;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AvatarFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $avatar = new Avatar();
        $avatar->setFilename('Ours');
        $manager->persist($avatar);

        $avatar = new Avatar();
        $avatar->setFilename('Lapin');
        $manager->persist($avatar);

        $avatar = new Avatar();
        $avatar->setFilename('Poulet');
        $manager->persist($avatar);

        $avatar = new Avatar();
        $avatar->setFilename('Renard');
        $manager->persist($avatar);

        $manager->flush();
    }
}