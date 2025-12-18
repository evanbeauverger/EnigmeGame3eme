<?php
// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('superadmin@free.fr');
        $user->setPassword('superadmin');
        $user->setIsVerified(true);
        $user->setRole(['ROLE_SUPER_ADMIN']);
        $manager->persist($user);

        $user = new User();
        $user->setEmail('admin@free.fr');
        $user->setPassword('admin');
        $user->setIsVerified(true);
        $user->setRole(['ROLE_ADMIN']);
        $manager->persist($user);

        $manager->flush();
    }
}