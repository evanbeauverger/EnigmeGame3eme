<?php
// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TeamFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $team = new Team();
        $team->setAvatar_id(1);
        $team->setName("les meilleurs");
        $manager->persist($team);

        $manager->flush();
    }
}