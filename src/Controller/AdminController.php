<?php

namespace App\Controller;

use App\Entity\Instructor;
use App\Repository\InstructorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @Route("/admin/dates", name="admin_set_dates")
     */
    public function setDates(): Response{
    }
}
