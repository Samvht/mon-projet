<?php

namespace App\DataFixtures;

use DateTime;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class User extends Fixture
{
        public function __construct(private UserPasswordHasherInterface $passwordHasher)

    {

    }
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 20; $i++) {
            $user = (new User())
                ->setNom("Nom $i")
                ->setPrenom("Prenom $i")
                ->setNbreConvive(random_int(0,5))
                ->setEmail("email.$i@studi.fr")
                ->setDateCreation(new DateTime());

            $user->setPassword($this->passwordHasher->hashPassword($user, 'password' . $i));

            $manager->persist($user);

        }
        $manager->flush();
    }
}
