<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Users;
use App\Entity\Category;
use App\Entity\Pictures;
use App\Entity\Tricks;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Faker\Factory::create('fr_FR');
        for ($i=0; $i < 5 ; $i++) { 
            $newCategory = new Category();
            $newCategory->setLabel($faker->word)
                     ->setCreatedAt( $faker->dateTime);
            $manager->persist($newCategory);
        }
        for ($i=0; $i < 30 ; $i++) { 
            $user = new Users();
            $user->setMail($faker->email)
                 ->setPassword( $faker->password)
                 ->setPseudo( $faker->userName)
                 ->setPicture("http://placehold.it/350x150")
                 ->setCreatedAt( $faker->dateTime);
            $manager->persist($user);
        }
        for ($i=0; $i < 20; $i++) { 
           $trick = new Tricks();
            $trick->setTitle($faker->text(200))
                  ->setContent($faker->paragraph())
                  ->setCategory(26)
                  ->setUser(86)
                  ->setCreatedAt($faker->dateTime);
            /*// on récupère un nombre aléatoire de Shops dans un tableau
            $randomCategory = (array) array_rand($category, rand(1, count($category)));
            // puis on les ajoute au Customer
            foreach ($randomCategory as $key => $value) {
                $trick[$i]->addCategory($category[$key]);
                $manager->persist($trick[$i]);
                $trick->setCategory($this->faker->randomElement(self::$category));
            */}/*
            $randomUser = (array) array_rand($user, rand(1, count($user)));
            // puis on les ajoute au Customer
            foreach ($randomUser as $key => $value) {
                $trick[$i]->addUser($user[$key]);
                $manager->persist($trick[$i]);
                $trick->setUser($trick[$i]);
            }
            
            $trick->setUser(6);
        }
            
            $manager->persist($trick);

        /*for ($i=0; $i < 20 ; $i++) { 
            $picture = new Pictures();
            $picture->setAdress("http://placehold.it/350x150")
                     ->setCreatedAt( $faker->dateTime);
            $manager->persist($picture);
        }*/

        $manager->flush();
    }
}