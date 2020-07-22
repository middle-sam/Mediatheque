<?php

namespace App\DataFixtures;



use App\Entity\Borrowing;
use App\Entity\Cd;
use APP\Entity\Creator;
use APP\Entity\Book;
use App\Entity\Documents;
use APP\Entity\Ebook;
use App\Entity\Dvd;
use App\Entity\Employee;
use App\Entity\IsInvolvedIn;
use App\Entity\MeetUp;
use App\Entity\Member;
use App\Entity\Newspaper;
use App\Entity\Participates;
use App\Entity\Ressources;
use App\Entity\User;
use App\Entity\Maintenance;
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

        $docRep = $this->manager->getRepository(Documents::class);
        $userRep = $this->manager->getRepository(User::class);
        $meetUpRep = $this->manager->getRepository(MeetUp::class);
        $creatorRep = $this->manager->getRepository(Creator::class);
        $employeeRep = $this->manager->getRepository(Employee::class);
        $memberRep = $this->manager->getRepository(Member::class);

        /**
         * Création des books
         */
    //  for ($i = 0; $i < 50; $i++){

    //      $book = new Book();
    //      $book->setTitre($faker->realText($maxNbChars = 25, $indexSize = 2));
    //      $book->setFormat($faker->randomElement($array = array("poche","standard","carré","grand format")));
    //      /**
    //       * Regex à améliorer, doit rendre le code-oeuvre composé de la catégorie(1,2 ou 3 lettres) + 3 premières lettres de l'auteur +
    //       * première lettre de l'oeuvre.
    //       */
    //      $book->setCodeOeuvre($faker->regexify('^[AEJR|(JBD)|(RP)|(RSF)|(BD)]-[A-Z]{3}-[A-Z]{1}'));
    //      $book->setCote($faker->ean8);
    //      $book->setPages($faker->numberBetween($min=10, $max=500 ));
    //      $book->setImg($faker->imageUrl(96, 128, 'abstract'));
    //      $manager->persist($book);
    //  }
    //  $manager->flush();

    //  /**
    //   * Création des ebook
    //   */
    //  for ($i = 0; $i < 50; $i++){

    //      $ebook = new Ebook();
    //      $ebook->setTitre($faker->realText($maxNbChars = 20, $indexSize = 2));
    //      $ebook->setFormat($faker->randomElement($array = array("poche","standard","carré","grand format")));
    //      $ebook->setCodeOeuvre($faker->regexify('^[AEJR|(JBD)|(RP)|(RSF)|(BD)]-[A-Z]{3}-[A-Z]{1}'));
    //      $ebook->setCote($faker->ean8);
    //      $ebook->setPages($faker->numberBetween($min=10, $max=300 ));
    //      $ebook->setImg($faker->imageUrl(96, 128, 'abstract'));
    //      $manager->persist($ebook);
    //  }
    //  $manager->flush();

    //  /**
    //   * Création des Cd
    //   */
    //  for ($i = 0; $i < 50; $i++){
    //      $hours= mt_rand(0,3);
    //      $ms= mt_rand(0,59);

    //      $randomInt = mt_rand(15,150);
    //      $cd = new Cd();
    //      $cd->setTitre($faker->realText($maxNbChars = 20, $indexSize = 2));
    //      $cd->setFormat($faker->randomElement($array = array('MP3','WAV','BWF','Ogg','AIFF','mp3PRO','CAF','RAW')));
    //      $cd->setCodeOeuvre($faker->regexify('^[AEJR|(JBD)|(RP)|(RSF)|(BD)]-[A-Z]{3}-[A-Z]{1}'));
    //      $cd->setCote($faker->ean8);
    //      $cd->setPlages($randomInt);
    //      $cd->setDuration("$hours:$ms:$ms");
    //      $cd->setImg($faker->imageUrl(96, 128, 'nature'));
    //      $manager->persist($cd);
    //  }
    //  $manager->flush();

    //  /**
    //   * Création des Dvd
    //   */
    //  for ($i = 0; $i < 50; $i++){

    //      $hours= mt_rand(0,3);
    //      $ms= mt_rand(0,59);

    //      $dvd = new Dvd();
    //      $dvd->setTitre($faker->realText($maxNbChars = 20, $indexSize = 2));
    //      $dvd->setFormat($faker->randomElement($array = array("VCD","SVCD","DVD","")));
    //      $dvd->setCodeOeuvre($faker->regexify('^[AEJR|(JBD)|(RP)|(RSF)|(BD)]-[A-Z]{3}-[A-Z]{1}'));
    //      $dvd->setCote($faker->ean8);
    //      $dvd->setDuration("$hours:$ms:$ms");
    //      $dvd->setImg($faker->imageUrl(96, 128, 'technics'));
    //      $manager->persist($dvd);
    //  }
    //  $manager->flush();

    //  /**
    //   * Création des journaux
    //   */
    //  for ($i = 0; $i < 50; $i++){

    //      $newspaper = new Newspaper();
    //      $newspaper->setTitre($faker->realText($maxNbChars = 20, $indexSize = 2));
    //      $newspaper->setFormat($faker->randomElement($array = array("single","album")));
    //      $newspaper->setCodeOeuvre($faker->regexify('^[AEJR|(JBD)|(RP)|(RSF)|(BD)]-[A-Z]{3}-[A-Z]{1}'));
    //      $newspaper->setCote($faker->ean8);
    //      $newspaper->setPeriodicity($faker->randomElement($array = array("Quotidien","Hebdomadaire","Mensuel")));
    //      $newspaper->setSubscriptionDate($faker->dateTimeBetween('-10 years', '-1 day'));
    //      $newspaper->setImg($faker->imageUrl(96, 128, 'city'));
    //      $manager->persist($newspaper);
    //  }
    //  $manager->flush();

    //  /**
    //   * Création des auteurs
    //   */
    //  for ($i = 0; $i < 50; $i++){

    //      $rand = mt_rand(0,15);
    //      $creator = new Creator();
    //      $creator->setFirstName($faker->firstName);
    //      $creator->setLastName($faker->lastName);
    //      $creator->setBirthDate($faker->dateTimeBetween('-100 years', '-1 day'));
    //      if( $rand >= 8 ){
    //          $creator->setDeathDate($faker->dateTimeBetween('-100 years', '-1 day'));
    //      }
    //      $manager->persist($creator);
    //  }
    //  $manager->flush();


    // /**
    // /* Création des Members
    // /*/
    // for ($i = 1; $i <= 50; $i++) {
    //     $mbr = new Member();
    //     $mbr->setPseudo($faker->realText($maxNbChars = 10));
    //     $mbr->setFirstName($faker->firstName);
    //     $mbr->setLastName($faker->lastName);
    //     $mbr->setPassword($faker->password);
    //     $mbr->setMembershipDate($faker->dateTimeBetween($startDate = '-24 months', $endDate = 'now', $timezone = null));
    //     $manager->persist($mbr);
    // }
    // $manager->flush();

    //  /**
    //  /* Création des employés
    //  /*/
    //  for ($i = 51; $i <= 100; $i++) {
    //      $employee = new Employee();
    //      $employee->setPseudo($faker->realText($maxNbChars = 10));
    //      $employee->setPhoneNumber($faker->e164PhoneNumber);
    //      $employee->setEmail($faker->email);
    //      $employee->setFirstName($faker->firstName);
    //      $employee->setLastName($faker->lastName);
    //      $employee->setPassword($faker->password);
    //      $manager->persist($employee);
    //  }
    //  $manager->flush();

    //  /**
    //  /* Création des Meetups
    //  /*/
    //  for ($i = 51; $i <= 100; $i++) {

    //      $mtup = new MeetUp();
    //      $mtup->setDate($faker->dateTimeBetween($startDate = 'now', $endDate = '+3 month', $timezone = null));
    //      $mtup->setEmployeeId($employeeRep->find($i));
    //      $mtup->setCreatorId($creatorRep->find($i - 50));
    //      $manager->persist($mtup);
    //  }
    //  $manager->flush();

      /**
       * Création des ressources
       */
      for ($i = 0; $i <= 50; $i++) {
          $ressources = new Ressources();
          $ressources->setTitle($faker->realText($maxNbChars = 50));
          $ressources->setType($faker->randomElement($array = array('article', 'video', 'movie','website')));
          $ressources->setDocumentId($docRep->find($faker->numberBetween($min = 1, $max = 250)));
          $manager->persist($ressources);
      }
      $manager->flush();

      /**
       * Création des Emprunts
       */
      for ($i = 0; $i <= 50; $i++){

          $br = new Borrowing();
          $br->setStartDate($faker->dateTimeBetween($startDate = '-365days', $endDate = '+15 days', $timezone = null));
          $br->setExpectedReturnDate($faker->dateTimeBetween($startDate = '+15days', $endDate = '+60 days', $timezone = null));
          $br->setEffectiveReturnDate($faker->dateTimeBetween($startDate = '+60days', $endDate = '+75 days', $timezone = null));
          $br->setMemberId($memberRep->find($faker->numberBetween($min = 1, $max = 50)));
          $br->setDocumentId($docRep->find($faker->numberBetween($min = 1, $max = 250)));
          $manager->persist($br);
      }
      $manager->flush();

      /**
       * Création des Participates
       */
      for ($i = 0; $i <= 50; $i++){

          $randomInt = mt_rand(15,150);
          $pts = new Participates();
          $pts->setPlaces($randomInt);
          $pts->setMeetUpId($meetUpRep->find($faker->numberBetween($min = 1, $max = 50)));
          $pts->setUserId($userRep->find($faker->numberBetween($min = 1, $max = 50)));
          $manager->persist($pts);
      }
      $manager->flush();


      /**
       * Création des IsInvolvedIn
       */
      for ($i = 0; $i < 50; $i++) {
          $isInvolvedIn = new IsInvolvedIn();

          $isInvolvedIn->setDocumentId($docRep->find($faker->numberBetween($min = 1, $max = 250)));

          switch (get_class($isInvolvedIn->getDocumentId())) {
              case "App\Entity\Dvd":
                  $isInvolvedIn->setRole($faker->randomElement($array = array('acteur', 'producteur', 'scénariste', 'réalisateur')));
                  break;
              case "App\Entity\Cd":
                  $isInvolvedIn->setRole($faker->randomElement($array = array('chanteur', 'compositeur', 'musicien')));
                  break;
              case "App\Entity\Newspaper":
                  $isInvolvedIn->setRole($faker->randomElement($array = array('rédacteur', 'producteur')));
                  break;
              case "App\Entity\Book":
                  $isInvolvedIn->setRole($faker->randomElement($array = array('éditeur', 'illustrateur', 'auteur')));
                  break;
              case "App\Entity\Ebook":
                  $isInvolvedIn->setRole($faker->randomElement($array = array('narrateur', 'auteur', 'illustrateur')));
                  break;
          }
          $isInvolvedIn->setCreatorId($creatorRep->find($faker->numberBetween($min = 1, $max = 50)));
          $manager->persist($isInvolvedIn);
      }
      $manager->flush();

      /**
       * Création de 50 maintenances
       */
      for ($i = 1; $i <= 50; $i++) {
          $maintenance = new Maintenance();
          $maintenance->setStatus($faker->randomElement($array = array('à changer', 'endommagé', 'correct', 'neuf')));
          $maintenance->setCreator($faker->realText( 15, 2));
          $maintenance->setMaintenanceDate($faker->dateTimeBetween($startDate = '- 2 years', $endDate = 'now', $timezone = null));
          $maintenance->setEmployeeId($employeeRep->find($i+50));
          $maintenance->setDocumentId($docRep->find($faker->numberBetween($min = 1, $max = 250)));
          $manager->persist($maintenance);
      }
      $manager->flush();

    }

}
