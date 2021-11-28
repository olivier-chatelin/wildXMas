<?php

namespace App\Controller;

use App\Entity\AvailableDays;
use App\Entity\DefaultReward;
use App\Entity\Instructor;
use App\Entity\Reward;
use App\Entity\Student;
use App\Form\AvailableDatesFormType;
use App\Form\RewardType;
use App\Repository\DefaultRewardRepository;
use App\Repository\InstructorRepository;
use App\Repository\RewardRepository;
use Cassandra\Timestamp;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RewardController extends AbstractController
{

    /**
     * @Route("/rewards", name="rewards")
     */
    public function rewardShow( InstructorRepository $instructorRepository, DefaultRewardRepository $defaultRewardRepository, EntityManagerInterface $entityManager): Response
    {
        $allRewards = $this->getUser()->getRewards();
        if (count($allRewards)===0){
            if ($this->getUser()->getIsFrench() && !$this->getUser()->getIsRemote()) {
                $dataSet = DefaultReward::FRENCH_REGULAR_CURRICULUM;
            }
            if (!$this->getUser()->getIsFrench() && !$this->getUser()->getIsRemote()) {
                $dataSet = DefaultReward::EUROPEAN_REGULAR_CURRICULUM;
            }
            if ($this->getUser()->getIsFrench() && $this->getUser()->getIsRemote()) {
                $dataSet = DefaultReward::FRENCH_REMOTE_CURRICULUM;
            }
            if (!$this->getUser()->getIsFrench() && $this->getUser()->getIsRemote()) {
                $dataSet = DefaultReward::EUROPEAN_REMOTE_CURRICULUM;
            }
                $data = $defaultRewardRepository->findOneBy(['name'=>$dataSet]);
                foreach ($data->getRewards() as $reward) {
                    $clonedData = clone $reward;
                    $this->getUser()->addReward($clonedData);
                    $entityManager->persist($clonedData);
                    $entityManager->flush();
                }

        }
        $rewards =[];
        $scheduledRewards = [];
        foreach ($allRewards as $reward) {
            if ($reward->getScheduledAt()) {
                $scheduledRewards[] = $reward;
            } else{
                $rewards[] = $reward;
            };
        }
        $christmasEve = date("Y") . "-12-24";
        $firstDecember = date("Y") . "-12-01";
        return $this->render('reward/rewards.html.twig',[
            'rewards'=>$rewards,
            'scheduled_rewards'=>$scheduledRewards,
            'display_tags'=>true,
            'end_date'=>$christmasEve,
            'start_date'=>$firstDecember,

        ]);

    }
    /**
     * @Route("/rewards/new", name="reward_new")
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
            return $this->redirectToRoute('rewards',[],Response::HTTP_SEE_OTHER);
        }
        return $this->render('reward/new.html.twig',[
            'form'=> $form->createView(),
            'reward'=> $reward,
            'display_tags' => true
        ]);

    }
    /**
     * @Route("/rewards/update/{id}", name="reward_update")
     */
    public function rewardUpdate(Reward $reward,Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RewardType::class, $reward);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('rewards', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('reward/edit.html.twig', [
            'reward' => $reward,
            'form' => $form,
            'display_tags' => true,

        ]);
    }
    /**
     * @Route("rewards/updateDate", name="reward_date_update", methods={"POST"})
     */
    public function updateDate(Request $request, EntityManagerInterface $entityManager, RewardRepository $rewardRepository): Response
    {
        $post = (json_decode($request->getContent()));
        $rewardId = (int)$post->rewardId;
        $date = $post->date;
        $reward = $rewardRepository->findOneBy(["id"=>$rewardId]);
        $dateTime = $date === "null" ?null:new \DateTime($date);
        $reward->setScheduledAt($dateTime);
        $entityManager->persist($reward);
        $entityManager->flush();
        return $this->json(['message'=>'reward updated']);
    }
    /**
     * @Route("/rewards/{id}", name="reward_delete", methods={"POST"})
     */
    public function delete(Request $request, Reward $reward, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reward->getId(), $request->request->get('_token'))) {
            $entityManager->remove($reward);
            $entityManager->flush();
        }

        return $this->redirectToRoute('rewards', [], Response::HTTP_SEE_OTHER);
    }
    /**
     * @Route("/rewards/show/{reward}/students/{student}", name="reward_show")
     */
    public function show(Reward $reward, Student $student, EntityManagerInterface $entityManager): Response
    {
        $reward->addStudent($student);
        $entityManager->flush();

        return $this->render('reward/show.html.twig',[
           'winner' => $student,
            'reward'=>$reward,
            'display_tags' => false,
            'size'=>'large'

        ]);
    }
    /**
     * @Route("/rewards/reset/{reward}", name="reward_reset_one")
     */
    public function resetOne(Reward $reward, EntityManagerInterface $entityManager): Response
    {
        foreach ($reward->getStudents() as $student) {
            $reward->removeStudent($student);
        }
        $entityManager->flush();
        return $this->redirectToRoute('home');
    }
}
