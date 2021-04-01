<?php

namespace App\DataFixtures;

use Faker;



use App\Entity\Maison;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
       // $maison = new Maison();
     //   $maison->setTitle('Maison de campagne');
      //  $maison->setDescription('Maison de campagne de grand pieces sol en marbre au bord de la tour ');
      //  $maison->setRooms(10);
       // $maison->setBedrooms(5);
     //   $maison->setPrice(200000);
     //   $maison->setSurface(180);
     //   $maison->setImg1('maison-1.png');
      //  $maison->setImg2('maison-2.png');
     //   $maison->setImg3('maison-3.png');

      $faker = Faker\Factory::create();

     for($i = 1; $i <= 10; $i++ ){

      $maison = new Maison();
      $maison->setTitle($faker->name($gender='male') );
      $maison->setDescription($faker->text(255) );
      $maison->setRooms($faker->numberBetween(6,10));
      $maison->setBedrooms($faker->numberBetween(1,5));
      $maison->setPrice($faker->numberBetween(75000,370000));
      $maison->setSurface($faker->numberBetween(29,199));
      $maison->setImg1('maison' .$i. '-1.png');
      $maison->setImg2('maison'.$i.'-2.png');
      $maison->setImg3('maison' . $i .'-3.png');
      $manager->persist($maison);

     }

    

        $manager->flush();
    }
}
