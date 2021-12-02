<?php

namespace App\Controller;

use App\Entity\Instructor;
use App\Entity\Reward;
use App\Repository\InstructorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OtherRewardController extends AbstractController
{
    /**
     * @Route("/other/reward", name="other_reward")
     */
    public function index(InstructorRepository $instructorRepository): Response
    {
        $allInstructors = $instructorRepository->findAll();
        $instructors = [];
        foreach ($allInstructors as $instructor) {
            if (explode('@',$instructor->getEmail())[1] === 'wildcodeschool.com' &&
                explode('@',$instructor->getEmail())[0] !== 'test2' &&
                explode('@',$instructor->getEmail())[0] !== 'test3') {
                $instructors[] = $instructor;
            }
        }

        return $this->render('other_reward/index.html.twig', [
            'instructors' => $instructors,
        ]);
    }
    /**
     * @Route("/other/reward/show/all/{id}", name="other_reward_show_all")
     */
    public function showAll(Instructor $instructor): Response
    {
        return $this->render('other_reward/show_all.html.twig', [
            'instructor' => $instructor
        ]);
    }
    /**
     * @Route("/other/reward/duplicate/{id}", name="other_reward_duplicate")
     */
    public function duplicate(Reward $reward, EntityManagerInterface $entityManager): Response
    {
        $newReward = new Reward();
        $newReward->setIsFrench($reward->getIsFrench());
        $newReward->setIsRemoteFriendly($reward->getIsRemoteFriendly());
        $newReward->setIsGood($reward->getIsGood());
        $newReward->setTitle($reward->getTitle());
        $newReward->setUrl($reward->getUrl());
        $newReward->addInstructor($this->getUser());
        $entityManager->persist($newReward);
        $entityManager->flush();
        $this->addFlash('success','The reward has been duplicated in your rewards field');
        return $this->redirectToRoute('other_reward_show_all',['id' => $reward->getInstructors()[0]->getId()]);

    }
}
