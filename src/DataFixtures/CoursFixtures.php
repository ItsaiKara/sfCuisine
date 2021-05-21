<?php

namespace App\DataFixtures;

use App\Entity\Cours;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CoursFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $user = new User();
        $user->setEmail("mail@admin1");
        $user->setPassword('$argon2id$v=19$m=65536,t=4,p=1$/nq/08HpqYYNNWE1eJ80mw$enn2e3YHyMOYZuzlwoKC/HlZ+cCKdzPB5pBnOEb7zgU');
        $user->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $user->setAlias('Dikxionaire');

        $manager->persist($user);

        for($i = 0; $i < 20; $i++) {
            $cours = new Cours();
            $cours->setResponsable($user);
            $cours->setNom("Cours de " . $i);
            $cours->setDescription("Description lorem ipsum " . $i);
            $cours->setTemps($i * 10);
            $cours->setDate(new \DateTime());
            $cours->setNbParticipants(rand(0, 30));
            $manager->persist($cours);
        }
        $manager->flush();
    }
}
