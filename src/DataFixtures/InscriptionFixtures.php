<?php

namespace App\DataFixtures;

use App\Entity\Cours;
use App\Entity\Inscription;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class InscriptionFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail("mail@adminIns");
        $user->setPassword('$argon2id$v=19$m=65536,t=4,p=1$/nq/08HpqYYNNWE1eJ80mw$enn2e3YHyMOYZuzlwoKC/HlZ+cCKdzPB5pBnOEb7zgU');
        $user->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $user->setAlias('Inscripteur');

        $manager->persist($user);

        $user2 = new User();
        $user2->setEmail("mail@adminIns2");
        $user2->setPassword('$argon2id$v=19$m=65536,t=4,p=1$/nq/08HpqYYNNWE1eJ80mw$enn2e3YHyMOYZuzlwoKC/HlZ+cCKdzPB5pBnOEb7zgU');
        $user2->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $user2->setAlias('Inscripteur2');

        $manager->persist($user2);

        $cours = new Cours();
        $cours->setResponsable($user);
        $cours->setNom("Cours d'ins" );
        $cours->setDescription("Description lorem ipsum ");
        $cours->setTemps(10);
        $cours->setDate(new \DateTime());
        $cours->setNbParticipants(3);
        $manager->persist($cours);

        $ins = new Inscription();
        $ins->setCours($cours);
        $ins->setUser($user);
        $manager->persist($ins);

        $ins2 = new Inscription();
        $ins2->setCours($cours);
        $ins2->setUser($user2);
        $manager->persist($ins2);

        $manager->flush();
    }
}
