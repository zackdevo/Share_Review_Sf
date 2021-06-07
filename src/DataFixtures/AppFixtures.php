<?php

namespace App\DataFixtures;

use App\Entity\Posts;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    private function encode($user, $plaintextpassword)
    {
        return $this->passwordEncoder->encodePassword(
            $user,
            $plaintextpassword
        );
    }
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create("fr_FR");
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setNickname($faker->firstName());
            $user->setPassword($this->encode($user, "toto"));
            $user->setRoles(["USER_ROLE"]);
            $manager->persist($user);

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
