<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $user = new User();
        $user->setEmail("mail@root");
        $user->setPassword('$argon2id$v=19$m=65536,t=4,p=1$/nq/08HpqYYNNWE1eJ80mw$enn2e3YHyMOYZuzlwoKC/HlZ+cCKdzPB5pBnOEb7zgU');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setAlias('Admin');

        $manager->persist($user);

        $manager->flush();
    }
}
