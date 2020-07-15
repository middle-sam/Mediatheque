<?php

namespace App\DataFixtures;

use APP\Entity\Creator;
use APP\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Faker\Factory::create('fr\FR');

        for ($i = 0; $i < 100; $i++){
//
            $rand = mt_rand(0, 10);
            $creator = new Creator();
            $creator->setFirstName($faker->firstName);
            $creator->setLastName($faker->lastName);
            $creator->setBirthDate($faker->dateTimeBetween('-100 years', '-1 day'));
//
            if( $rand>=5 ){
                $creator->setDeathDate($faker->dateTimeBetween('-100 years', '-1 day'));
            }elseif( $rand<5 ){
                $creator->setDeathDate(null);
            }
//
            $manager->persist($creator);
        }
        for ($i = 0; $i < 150; $i++){

            $book = new Book();
            $book->setTitre($faker->realText($maxNbChars = 25, $indexSize = 2));
            $book->setFormat($faker->randomElement($array = array("poche","standard","carré","grand format")));
            $book->setCodeOeuvre($faker->regexify('^[AEJR|(JBD)|(RP)|(RSF)|(BD)]-[A-Z]{3}-[A-Z]{1}'));
            $book->setCote($faker->ean8);
            $book->setPages($faker->numberBetween($min=10, $max=2000 ));
            $manager->persist($book);
        }

        $manager->flush();
    }
}
