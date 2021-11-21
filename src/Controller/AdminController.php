<?php

namespace App\Controller;

use App\Entity\AvailableDays;
use App\Entity\Instructor;
use App\Entity\Reward;
use App\Form\AvailableDatesFormType;
use App\Form\RewardType;
use App\Repository\InstructorRepository;
use App\Repository\RewardRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    /**
     * @Route("/admin/instructors", name="admin_instructors")
     */
    public function instructorsShow(InstructorRepository $instructorRepository): Response
    {
        $instructors = $instructorRepository->findAll();
        return $this->render('admin/instructors.html.twig', [
            'instructors' => $instructors,
        ]);
    }
    /**
     * @Route("/admin/instructors/update/{id}", name="admin_instructor_update")
     */
    public function instructorsUpdate(Instructor $instructor, EntityManagerInterface $entityManager): Response
    {
        if(in_array("ROLE_ADMIN",$instructor->getRoles())) {
            $instructor->removeRole("ROLE_ADMIN");
        } else{
            $instructor->addRoles("ROLE_ADMIN");
        }
        $entityManager->persist($instructor);
        $entityManager->flush();
        return $this->redirectToRoute('admin_instructors');
    }
    /**
     * @Route("/admin/rewards", name="admin_rewards")
     */
    public function rewardShow( InstructorRepository $instructorRepository): Response
    {
        $rewards = $this->getUser()->getRewards();

        return $this->render('admin/reward/rewards.html.twig',[
            'rewards'=>$rewards
        ]);

    }
    /**
     * @Route("/admin/reward/new", name="admin_reward_new")
     */
    public function rewardNew(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reward = new Reward();
        $form = $this->createForm(RewardType::class, $reward);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $reward->addInstructor($this->getUser());
            $entityManager->persist($reward);
            $entityManager->flush();
            return $this->redirectToRoute('admin_rewards');
        }
        return $this->render('admin/reward/new.html.twig',[
            'form'=>$form->createView(),
        ]);

    }
}
