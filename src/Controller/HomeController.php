<?php

namespace App\Controller;

use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {

        $eligibleStudents = [];
        $scheduledRewards = [];
        if($this->getUser()) {
            $allStudents = $this->getUser()->getStudents();
            foreach ($allStudents as $student) {
                dump(count($student->getRewards()));
                if(count($student->getRewards()) === 0) {
                    $eligibleStudents[] = $student;
                }
            }
            foreach ($this->getUser()->getRewards() as $reward) {
                if($reward->getScheduledAt()) {
                    $scheduledRewards[] = $reward;
                }
            }
        }
        $christmasEve = date("Y") . "-12-24";
        $firstDecember = date("Y") . "-12-01";
        $roles=$this->getUser()?$this->getUser()->getRoles():[];
        return $this->render('home/index.html.twig', [
            'roles' => $roles,
            'students' => $eligibleStudents,
            'scheduled_rewards'=>$scheduledRewards,
            'end_date'=>$christmasEve,
            'start_date'=>$firstDecember,
            'curtains' => true

        ]);
    }
}
