<?php

namespace App\DataFixtures;

use App\Entity\DefaultReward;
use App\Entity\Instructor;
use App\Entity\Reward;
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

        $instructor = new Instructor();
        $instructor->setEmail('fr-rem@gmail.com');
        $instructor->setIsFrench(true);
        $instructor->setIsRemote(true);
        $instructor->setPassword($this->encoder->encodePassword($instructor, '123456'));
        $instructor->addRoles('ROLE_USER');
        $manager->persist($instructor);

        $instructor = new Instructor();
        $instructor->setEmail('fr-reg@gmail.com');
        $instructor->setIsFrench(true);
        $instructor->setIsRemote(false);
        $instructor->setPassword($this->encoder->encodePassword($instructor, '123456'));
        $instructor->addRoles('ROLE_USER');
        $manager->persist($instructor);

        $instructor = new Instructor();
        $instructor->setEmail('eur-reg@gmail.com');
        $instructor->setIsFrench(false);
        $instructor->setIsRemote(false);
        $instructor->setPassword($this->encoder->encodePassword($instructor, '123456'));
        $instructor->addRoles('ROLE_USER');
        $manager->persist($instructor);

        $instructor = new Instructor();
        $instructor->setEmail('eur-rem@gmail.com');
        $instructor->setIsFrench(false);
        $instructor->setIsRemote(true);
        $instructor->setPassword($this->encoder->encodePassword($instructor, '123456'));
        $instructor->addRoles('ROLE_USER');
        $manager->persist($instructor);

        $reward1 = new Reward();
        $reward1 ->setTitle('Recevoir un badge')
                ->setUrl('https://i.ibb.co/DMDJCZg/badge.png')
                ->setIsGood(true)
                ->setIsFrench(true)
                ->setIsRemoteFriendly(true)
                ->addInstructor($superAdmin);
        $manager->persist($reward1);

        $reward1 = new Reward();
        $reward1 ->setTitle('Here\'s a new badge especially for you')
                ->setUrl('https://i.ibb.co/DMDJCZg/badge.png')
                ->setIsGood(true)
                ->setIsFrench(false)
                ->setIsRemoteFriendly(true)
                ->addInstructor($superAdmin);
        $manager->persist($reward1);

        $reward2 = new Reward();
        $reward2 ->setTitle('Porter un objet de Noël toute la journée')
                ->setUrl('https://i.ibb.co/rFwFRrn/t-l-chargement-1-1.jpg')
                ->setIsGood(true)
                ->setIsFrench(true)
                ->setIsRemoteFriendly(true)
                ->addInstructor($superAdmin);
        $manager->persist($reward2);

        $reward3 = new Reward();
        $reward3 ->setTitle('Réussir un codewars choisi par ton formateur')
                ->setUrl('https://i.ibb.co/GVyC3Ct/t-l-chargement-2.jpg')
                ->setIsGood(true)
                ->setIsFrench(true)
                ->setIsRemoteFriendly(true)
                ->addInstructor($superAdmin);
        $manager->persist($reward3);

        $reward = new Reward();
        $reward ->setTitle('Faire une quête d\'un autre cursus' )
                ->setUrl('https://i.ibb.co/1X5tQ5P/photo-portrait-bearded-student-playing-260nw-1869601915.png')
                ->setIsGood(true)
                ->setIsFrench(true)
                ->setIsRemoteFriendly(true)
                ->addInstructor($superAdmin);
        $manager->persist($reward);

        $reward = new Reward();
        $reward ->setTitle('échanger sa veille')
                ->setUrl('https://i.ibb.co/LnxrG0y/les-objectifs-de-la-veille-technologique-300x300.jpg')
                ->setIsGood(true)
                ->setIsFrench(true)
                ->setIsRemoteFriendly(true)
                ->addInstructor($superAdmin);
        $manager->persist($reward);

        $reward = new Reward();
        $reward ->setTitle('Réaliser et animer un dojo')
                ->setUrl('https://i.ibb.co/7z0nF8Z/Seattle-Budokan-Dojo-judo-demo-04.jpg')
                ->setIsGood(false)
                ->setIsFrench(true)
                ->setIsRemoteFriendly(true)
                ->addInstructor($superAdmin);
        $manager->persist($reward);

        $reward = new Reward();
        $reward ->setTitle('Recevoir un objet wild')
                ->setUrl('https://i.ibb.co/drfcF9y/t-l-chargement.png')
                ->setIsGood(true)
                ->setIsFrench(true)
                ->setIsRemoteFriendly(true)
                ->addInstructor($superAdmin);
        $manager->persist($reward);


        $reward = new Reward();
        $reward ->setTitle('Faire son daily en anglais')
                ->setUrl('https://i.ibb.co/xSnHyXJ/joey.jpg')
                ->setIsGood(true)
                ->setIsFrench(true)
                ->setIsRemoteFriendly(true)
                ->addInstructor($superAdmin);
        $manager->persist($reward);

        $reward = new Reward();
        $reward ->setTitle('Devenir le délégué de la semaine')
                ->setUrl('https://i.ibb.co/r7mBbDj/cea32b77cc47ad7a0d51c4eb3c8c52e5b87bf9fc.jpg')
                ->setIsGood(true)
                ->setIsFrench(true)
                ->setIsRemoteFriendly(true)
                ->addInstructor($superAdmin);
        $manager->persist($reward);

        $reward = new Reward();
        $reward ->setTitle('Coder toute la journée avec un autre IDE')
                ->setUrl('https://i.ibb.co/qFWy7Tz/Coding-html-and-css-in-IDE-macro-Software-development-Software-source-code.jpg')
                ->setIsGood(true)
                ->setIsFrench(true)
                ->setIsRemoteFriendly(true)
                ->addInstructor($superAdmin);
        $manager->persist($reward);

        $reward = new Reward();
        $reward ->setTitle('MODIFIER TON PSEUDO EN "PÈRE NOËL" et répondre à toutes les demandes de ta promo')
                ->setUrl('https://i.ibb.co/BzLXp3K/le-pere-noel-est-une-ordure-28-decembre.jpg')
                ->setIsGood(false)
                ->setIsFrench(true)
                ->setIsRemoteFriendly(true)
                ->addInstructor($superAdmin);
        $manager->persist($reward);


        $reward = new Reward();
        $reward ->setTitle('animer un live coding')
                ->setUrl('https://i.ibb.co/zZCj14Y/1035918.jpg')
                ->setIsGood(false)
                ->setIsFrench(true)
                ->setIsRemoteFriendly(true)
                ->addInstructor($superAdmin);
        $manager->persist($reward);

        $reward = new Reward();
        $reward ->setTitle('Short day de 30 min')
                ->setUrl('https://i.ibb.co/bKwTL8n/images-1.jpg')
                ->setIsGood(true)
                ->setIsFrench(true)
                ->setIsRemoteFriendly(true)
                ->addInstructor($superAdmin);
        $manager->persist($reward);

        $reward = new Reward();
        $reward ->setTitle('se déguiser en son formateur')
                ->setUrl('https://i.ibb.co/T0671cW/maurice-moss-it-crowd.jpg')
                ->setIsGood(true)
                ->setIsFrench(true)
                ->setIsRemoteFriendly(true)
                ->addInstructor($superAdmin);
        $manager->persist($reward);

        $reward = new Reward();
        $reward ->setTitle('Faire une veille en plus')
                ->setUrl('https://i.ibb.co/hXSmtxb/t-l-chargement.jpg')
                ->setIsGood(false)
                ->setIsFrench(true)
                ->setIsRemoteFriendly(true)
                ->addInstructor($superAdmin);
        $manager->persist($reward);

        $reward = new Reward();
        $reward ->setTitle('Choisis le jeu de ce soir')
                ->setUrl('https://i.ibb.co/qkP52Py/images.jpg')
                ->setIsGood(true)
                ->setIsFrench(true)
                ->setIsRemoteFriendly(false)
                ->addInstructor($superAdmin);
        $manager->persist($reward);

        $reward = new Reward();
        $reward ->setTitle('Ton formateur te fait ton café toute la journée')
                ->setUrl('https://i.ibb.co/Drd9dxK/6944-full.png')
                ->setIsGood(true)
                ->setIsFrench(true)
                ->setIsRemoteFriendly(false)
                ->addInstructor($superAdmin);
        $manager->persist($reward);

        $reward = new Reward();
        $reward ->setTitle('Bon pour  une grasse mat\' (accord avec ton formateur et ton SEM' )
                ->setUrl('https://i.ibb.co/Srb2rS6/2000003627084.jpg')
                ->setIsGood(true)
                ->setIsFrench(true)
                ->setIsRemoteFriendly(true)
                ->addInstructor($superAdmin);
        $manager->persist($reward);

        $reward = new Reward();
        $reward ->setTitle('faire un gâteau ou emporter des bonbons')
                ->setUrl('https://i.ibb.co/3yNHYbM/g-teau-maxi-fiesta-en-bonbons.jpg')
                ->setIsGood(true)
                ->setIsFrench(true)
                ->setIsRemoteFriendly(false)
                ->addInstructor($superAdmin);
        $manager->persist($reward);

        $reward = new Reward();
        $reward ->setTitle('Make a cake or bring some candies')
                ->setUrl('https://i.ibb.co/3yNHYbM/g-teau-maxi-fiesta-en-bonbons.jpg')
                ->setIsGood(true)
                ->setIsFrench(false)
                ->setIsRemoteFriendly(false)
                ->addInstructor($superAdmin);
        $manager->persist($reward);

        $table = new DefaultReward();
        $table->setName(DefaultReward::EUROPEAN_REMOTE_CURRICULUM);
        $manager->persist($table);

        $table = new DefaultReward();
        $table->setName(DefaultReward::EUROPEAN_REGULAR_CURRICULUM);
        $manager->persist($table);

        $table = new DefaultReward();
        $table->setName(DefaultReward::FRENCH_REMOTE_CURRICULUM);
        $manager->persist($table);

        $table = new DefaultReward();
        $table->setName(DefaultReward::FRENCH_REGULAR_CURRICULUM);
        $manager->persist($table);

        $manager->persist($superAdmin);
        $manager->flush();
    }
}
