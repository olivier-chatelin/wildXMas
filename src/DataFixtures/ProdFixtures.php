<?php

namespace App\DataFixtures;

use App\Entity\Instructor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ProdFixtures extends Fixture
{
    private UserPasswordEncoderInterface $encoder;


    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        $superAdmin = new Instructor();
        $superAdmin->setEmail('camille.sabatier@wildcodeschool.com');
        $superAdmin->setPassword($this->encoder->encodePassword($superAdmin, 'JULc2la2mer'));
        $superAdmin->addRoles('ROLE_SUPER_ADMIN');
        $superAdmin->addRoles('ROLE_ADMIN');
        $superAdmin->addRoles('ROLE_USER');
        $manager->persist($superAdmin);
        $manager->flush();
    }
}
