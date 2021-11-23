<?php

namespace App\Controller;

use App\Entity\DefaultReward;
use App\Entity\Reward;
use App\Repository\DefaultRewardRepository;
use App\Repository\RewardRepository;
use App\Service\RewardExporter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultTableController extends AbstractController
{
    /**
     * @Route("/admin/export/{name}", name="admin_export")
     */
    public function exportFrReg(DefaultRewardRepository $defaultRewardRepository, EntityManagerInterface $entityManager, RewardRepository $rewardRepository, DefaultReward $defaultTable): Response
    {
        $defaultTable->removeAllRewards();
        $allRewards = $this->getUser()->getRewards();
        $errors = [];
        foreach ($allRewards as $reward) {
            if($reward->getScheduledAt()) {
                if(!$reward->getIsFrench() && ($defaultTable->getName() === DefaultReward::FRENCH_REGULAR_CURRICULUM || $defaultTable->getName() === DefaultReward::FRENCH_REMOTE_CURRICULUM)){
                    $this->addFlash('danger','Error Cannot persist there is a reward in english');
                    $errors[] = 'Error Cannot persist there is an english reward';
                }
                if($reward->getIsFrench() && ($defaultTable->getName() === DefaultReward::EUROPEAN_REMOTE_CURRICULUM || $defaultTable->getName() === DefaultReward::EUROPEAN_REGULAR_CURRICULUM)){
                    $this->addFlash('danger','Error Cannot persist there is a reward in french');
                    $errors[] = 'Error Cannot persist there is an english reward';
                }
                if(!$reward->getIsRemoteFriendly() && ($defaultTable->getName() === DefaultReward::FRENCH_REMOTE_CURRICULUM || $defaultTable->getName() === DefaultReward::EUROPEAN_REMOTE_CURRICULUM)){
                    $this->addFlash('danger','Error Cannot persist there is a not remote friendly');
                    $errors[] = 'Error Cannot persist there is an non remote friendly reward';
                }

                $clonedReward = clone $reward;
                $entityManager->persist($clonedReward);
                $defaultTable->addReward($clonedReward);
            }
            $entityManager->persist($defaultTable);
            $entityManager->flush();
        }

        if (empty($errors)) {
            $this->addFlash('success','Rewards were successfully exported to instructors');
        }
        return $this->redirectToRoute('rewards');
    }
}
