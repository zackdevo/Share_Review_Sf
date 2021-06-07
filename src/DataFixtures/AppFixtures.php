<?php

namespace App\DataFixtures;

use App\Entity\Posts;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create("fr_FR");
        for ($i = 0; $i < 10; $i++) {
            $onePost = new Posts;
            $onePost->setCreatedAt($faker->dateTime($max = "now", null));
            $onePost->setTitle($faker->sentence(5));
            $onePost->setSubtitle($faker->sentence(4));
            $onePost->setContent($faker->paragraph(4));
            $manager->persist($onePost);
        }
        $manager->flush();
    }
}
