<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;


class AppFixtures extends Fixture
{
    /** @noinspection PhpHierarchyChecksInspection */
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr\FR');
        if(!isset($book)){
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

        if(!isset($creator)){
            for ($i = 0; $i < 100; $i++){

                $creator = new Creator();
                $creator->setFirstName($faker->firstName($gender = null|'male'|'female'));
                $creator->setLastName($faker->lastName);
                $creator->setBirthDate($faker->date($format = 'd-m-Y', $max = '-7 years'));
                $creator->setDeathDate($faker->date($format = 'd-m-Y', $max = null | '-1 month'));
                $manager->persist($creator);
            }

            $manager->flush();
        }

    }

}
