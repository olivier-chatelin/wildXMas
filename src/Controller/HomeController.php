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
    public function index(StudentRepository $studentRepository): Response
    {
        $students = [];
        if($this->getUser()) {
            $students = $this->getUser()->getStudents();
        }
        $roles=$this->getUser()?$this->getUser()->getRoles():[];
        return $this->render('home/index.html.twig', [
            'roles' => $roles,
            'students' => $students
        ]);
    }
}
