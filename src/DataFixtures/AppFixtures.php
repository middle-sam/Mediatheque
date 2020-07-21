<?php

namespace App\DataFixtures;



use App\Entity\Borrowing;
use App\Entity\Cd;
use APP\Entity\Creator;
use APP\Entity\Book;
use APP\Entity\Ebook;
use App\Entity\Dvd;
use App\Entity\MeetUp;
use App\Entity\Member;
use App\Entity\Newspaper;
use App\Entity\Participates;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Faker;

class AppFixtures extends Fixture
{

    private $manager;

    public function __construct(EntityManagerInterface $entityManager){

        $this->manager = $entityManager;

    }
    public function load(ObjectManager $manager)
    {


        $faker = Faker\Factory::create('fr_FR');


        /**
         * Création des auteurs
         */
        for ($i = 0; $i < 50; $i++){

            $rand = mt_rand(0,15);
            $creator = new Creator();
            $creator->setFirstName($faker->firstName);
            $creator->setLastName($faker->lastName);
            $creator->setBirthDate($faker->dateTimeBetween('-100 years', '-1 day'));

            /**
             * Permet de randomiser les Deathdate, le "elseif" peut être supprimé pour éviter d'avoir des valeurs "null" en
             * BDD
             */
            if( $rand >= 8 ){
                $creator->setDeathDate($faker->dateTimeBetween('-100 years', '-1 day'));
            }/*elseif( $rand<5 ){
                $creator->setDeathDate(null);
            }*/

            $manager->persist($creator);
        }

        /**
         * Création des livres
         */
        for ($i = 0; $i < 50; $i++){

            $book = new Book();
            $book->setTitre($faker->realText($maxNbChars = 25, $indexSize = 2));
            $book->setFormat($faker->randomElement($array = array("poche","standard","carré","grand format")));
            /**
             * Regex à améliorer, doit rendre le code-oeuvre composé de la catégorie(1,2 ou 3 lettres) + 3 premières lettres de l'auteur +
             * première lettre de l'oeuvre.
             */
            $book->setCodeOeuvre($faker->regexify('^[AEJR|(JBD)|(RP)|(RSF)|(BD)]-[A-Z]{3}-[A-Z]{1}'));
            $book->setCote($faker->ean8);
            $book->setPages($faker->numberBetween($min=10, $max=500 ));
            $manager->persist($book);
        }

        /**
         * Création des Cd
         */
        for ($i = 0; $i < 50; $i++){

            $hours= mt_rand(0,3);
            $ms= mt_rand(0,59);

            $randomInt = mt_rand(15,150);
            $cd = new Cd();
            $cd->setTitre($faker->realText($maxNbChars = 20, $indexSize = 2));
            $cd->setFormat($faker->randomElement($array = array("single","album")));
            $cd->setCodeOeuvre($faker->regexify('^[AEJR|(JBD)|(RP)|(RSF)|(BD)]-[A-Z]{3}-[A-Z]{1}'));
            $cd->setCote($faker->ean8);
            $cd->setPlages($randomInt);
            $cd->setDuration("$hours:$ms:$ms");
            $manager->persist($cd);
        }


        /**
         * Création des Dvd
         */
        for ($i = 0; $i < 50; $i++){

            $hours= mt_rand(0,3);
            $ms= mt_rand(0,59);

            $dvd = new Dvd();
            $dvd->setTitre($faker->realText($maxNbChars = 20, $indexSize = 2));
            $dvd->setFormat($faker->randomElement($array = array("single","album")));
            $dvd->setCodeOeuvre($faker->regexify('^[AEJR|(JBD)|(RP)|(RSF)|(BD)]-[A-Z]{3}-[A-Z]{1}'));
            $dvd->setCote($faker->ean8);
            $dvd->setDuration("$hours:$ms:$ms");
            $manager->persist($dvd);
        }


        /**
         * Création des journaux
         */
        for ($i = 0; $i < 50; $i++){

            $newspaper = new Newspaper();
            $newspaper->setTitre($faker->realText($maxNbChars = 20, $indexSize = 2));
            $newspaper->setFormat($faker->randomElement($array = array("single","album")));
            $newspaper->setCodeOeuvre($faker->regexify('^[AEJR|(JBD)|(RP)|(RSF)|(BD)]-[A-Z]{3}-[A-Z]{1}'));
            $newspaper->setCote($faker->ean8);
            $newspaper->setPeriodicity($faker->randomElement($array = array("Quotidien","Hebdomadaire","Mensuel")));
            $newspaper->setSubscriptionDate($faker->dateTimeBetween('-10 years', '-1 day'));
            $manager->persist($newspaper);
        }


        /**
         * Création des ebook
         */
        for ($i = 0; $i < 50; $i++){

            $ebook = new Ebook();
            $ebook->setTitre($faker->realText($maxNbChars = 20, $indexSize = 2));
            $ebook->setFormat($faker->randomElement($array = array("poche","standard","carré","grand format")));
            $ebook->setCodeOeuvre($faker->regexify('^[AEJR|(JBD)|(RP)|(RSF)|(BD)]-[A-Z]{3}-[A-Z]{1}'));
            $ebook->setCote($faker->ean8);
            $ebook->setPages($faker->numberBetween($min=10, $max=2000 ));
            $manager->persist($ebook);
        }

        /**
         * Création des Emprunts
         */
        for ($i = 0; $i < 10; $i++){
//
            $br = new Borrowing();
            $rand = mt_rand(1,11);
            $br->setMemberId($rand);
            $br->setStartDate($faker->dateTimeBetween($startDate = '-365days', $endDate = '+15 days', $timezone = null));
            $br->setExpectedReturnDate($faker->dateTimeBetween($startDate = '+15days', $endDate = '+60 days', $timezone = null));
            $br->setEffectiveReturnDate($faker->dateTimeBetween($startDate = '+60days', $endDate = '+75 days', $timezone = null));
            $manager->persist($br);
        }

        /**
         * Création des Members
         */
        for ($i = 0; $i < 50; $i++){
            $mbr = new Member();
            $mbr->setMembershipDate($faker->dateTimeBetween($startDate = '-24 months', $endDate = 'now', $timezone = null));
            $manager->persist($mbr);
        }

        /**
         * Création des Users
         */
        for ($i = 0; $i < 50; $i++){

            $usr = new User();
            $usr->setPseudo($faker->realText($maxNbChars = 25, $indexSize = 2));
            $usr->setFirstName($faker->firstName);
            $usr->setLastName($faker->lastName);
            $usr->setPassword($faker->md5);
            $manager->persist($usr);
        }

        /**
         * Création des Participates
         */
        for ($i = 0; $i < 50; $i++){

            $randomInt = mt_rand(15,150);
            $pts = new Participates();
            $pts->setPlaces($randomInt);
            $manager->persist($pts);
        }

        /**
         * Création des Meetups
         */
        for ($i = 0; $i < 15; $i++){

            $mtup = new MeetUp();
            $mtup->setDate($faker->dateTimeBetween($startDate = 'now', $endDate = '+3 month', $timezone = null));
            $manager->persist($mtup);
        }

        $manager->flush();
    }
}
