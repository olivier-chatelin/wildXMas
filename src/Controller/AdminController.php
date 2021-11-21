<?php

namespace App\Controller;

use App\Entity\AvailableDays;
use App\Entity\Instructor;
use App\Entity\Reward;
use App\Form\AvailableDatesFormType;
use App\Form\RewardType;
use App\Repository\InstructorRepository;
use App\Repository\RewardRepository;
use Cassandra\Timestamp;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     * @IsGranted("ROLE_ADMIN")
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
        $christmasEve = date("Y") . "-12-24";
        $firstDecember = date("Y") . "-12-01";
        return $this->render('admin/reward/rewards.html.twig',[
            'rewards'=>$rewards,
            'display_tags'=>true,
            'end_date'=>$christmasEve,
            'start_date'=>$firstDecember,

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
            return $this->redirectToRoute('admin_rewards',[],Response::HTTP_SEE_OTHER);
        }
        return $this->render('admin/reward/new.html.twig',[
            'form'=> $form->createView(),
            'reward'=> $reward,
            'display_tags' => true
        ]);

    }
    /**
     * @Route("/admin/reward/update/{id}", name="admin_reward_update")
     */
    public function rewardUpdate(Reward $reward,Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RewardType::class, $reward);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('admin_rewards', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('admin/reward/edit.html.twig', [
            'reward' => $reward,
            'form' => $form,
            'display_tags' => true,

        ]);
    }
    /**
    * @Route("admin/{id}", name="admin_reward_delete", methods={"POST"})
    */
    public function delete(Request $request, Reward $reward, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reward->getId(), $request->request->get('_token'))) {
            $entityManager->remove($reward);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_rewards', [], Response::HTTP_SEE_OTHER);
    }

}
