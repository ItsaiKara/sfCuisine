<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Recette;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RecetteFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $user = new User();
        $user->setEmail("mail@us1");
        $user->setPassword('$argon2id$v=19$m=65536,t=4,p=1$/nq/08HpqYYNNWE1eJ80mw$enn2e3YHyMOYZuzlwoKC/HlZ+cCKdzPB5pBnOEb7zgU');
        $user->setRoles(['ROLE_USER']);
        $user->setAlias('Alfred Stolfo');

        $manager->persist($user);

        $user2 = new User();
        $user2->setEmail("mail@us2");
        $user2->setPassword('$argon2id$v=19$m=65536,t=4,p=1$/nq/08HpqYYNNWE1eJ80mw$enn2e3YHyMOYZuzlwoKC/HlZ+cCKdzPB5pBnOEb7zgU');
        $user2->setRoles(['ROLE_USER']);
        $user2->setAlias('Argyle Failyx');

        $manager->persist($user2);


        $cat = new Categorie();
        $cat->setNom("Entrée");
        $manager->persist($cat);

        $cat2 = new Categorie();
        $cat2->setNom("Plat");
        $manager->persist($cat2);

        $cat3 = new Categorie();
        $cat3->setNom("Dessert");
        $manager->persist($cat3);

        for($i = 0; $i < 20; $i++){
            $rec = new Recette();
            if ($i >=10 ){
                $rec->setAutheur($user);
            }
            else {
                $rec->setAutheur($user2);
            }
            $rec->setNom("Recette".$i);
            $rec->setDescription("Description".$i);
            $rec->setIngredients("lorem ipsum; ddsfffdsgfdsqsdfdhfdsfdg; fdghffdsfjhgdsfhgdsfref; hgfdfsfdghqdsgfhrezfgdretfdg");
            $rec->setDate(new \DateTime());
            //$currentDateTime = date('m-d-Y');
            if ($i < 7){
                $rec->setCategorie($cat);
            } else if ( $i >=7 and $i >= 14){
                $rec->setCategorie($cat2);
            } else {
                $rec->setCategorie($cat3);
            }


            $rec->setEtapes("Acheter tomates; Laver tomates/moza; Couper tomates/moza; Dresser");
            $rec->setImage("default.png");
            $rec->setTemps($i*10);
            $manager->persist($rec);
        }

        $manager->flush();
    }
}
