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

class AdminController extends AbstractController
{
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


}
