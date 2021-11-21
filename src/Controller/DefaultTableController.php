<?php

namespace App\Controller;

use App\Entity\DefaultReward;
use App\Entity\Reward;
use App\Repository\DefaultRewardRepository;
use App\Repository\RewardRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultTableController extends AbstractController
{
    /**
     * @Route("/admin/export/french/regular", name="admin_export_fr_reg")
     */
    public function exportFrReg(DefaultRewardRepository $defaultRewardRepository, EntityManagerInterface $entityManager): Response
    {
        $defaultTable = $defaultRewardRepository->findOneBy(['name'=>DefaultReward::FRENCH_REGULAR_CURRICULUM]);
        if (!$defaultTable) {
            $defaultTable = new DefaultReward();
            $defaultTable->setName(DefaultReward::FRENCH_REGULAR_CURRICULUM);
        } else {
            $defaultTable->removeAllRewards();
        }
        $allRewards = $this->getUser()->getRewards();
        foreach ($allRewards as $reward) {
            if($reward->getScheduledAt()) {
                if(!$reward->getIsFrench()){
                    $this->addFlash('danger','Error Cannot persist there is an english reward');
                    return $this->redirectToRoute('admin_rewards');
                }
                $clonedReward = clone $reward;
                $entityManager->persist($clonedReward);
                $defaultTable->addReward($clonedReward);
            }
            $entityManager->persist($defaultTable);
            $entityManager->flush();

        }
        $this->addFlash('success','Rewards were successfully exported to instructors');
        return $this->redirectToRoute('rewards');
    }
}
