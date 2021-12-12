<?php

namespace App\Controller;

use App\Entity\Reward;
use App\Repository\RewardRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrollController extends AbstractController
{
    /**
     * @Route("/troll", name="troll")
     */
    public function index(EntityManagerInterface $entityManager, RewardRepository $rewardRepository): Response
    {

        foreach ($this->getUser()->getRewards() as $reward) {
            if($reward->getScheduledAt()) {
               if ($reward->getScheduledAt()->format('Y-m-d') === '2021-12-12') {
                   $reward->setScheduledAt(null);
                   $entityManager->persist($reward);
               };
            }
        }
        $rewardTest = new Reward();
        $rewardTest->setIsFrench(true);
        $rewardTest->setIsGood(true);
        $rewardTest->setIsRemoteFriendly(true);
        $rewardTest->setTitle('Guillaume te fait un live coding en tête à tête. Sujet de ton choix');
        $rewardTest->setUrl('https://i.pinimg.com/originals/9d/10/d2/9d10d267230d7252efe00d016c60933b.jpg');
        $rewardTest->setScheduledAt(new \DateTime('2021-12-12'));
        $rewardTest->addInstructor($this->getUser());
        $entityManager->persist($rewardTest);
       $entityManager->flush();
        return $this->json($rewardTest->getId());
    }
}
