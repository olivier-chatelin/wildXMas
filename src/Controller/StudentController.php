<?php

namespace App\Controller;

use App\Entity\CsvFile;
use App\Entity\Student;
use App\Form\CsvFileType;
use App\Form\StudentType;
use App\Repository\StudentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/student")
 */
class StudentController extends AbstractController
{
    /**
     * @Route("/", name="student_index", methods={"GET", "POST"})
     */
    public function index(Request $request, StudentRepository $studentRepository, EntityManagerInterface $entityManager): Response
    {
        $csvFile = new CsvFile();
        $form = $this->createForm(CsvFileType::class,$csvFile);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($csvFile);
            $this->getUser()->setCsvFile($csvFile);
            $entityManager->flush();
            $this->addFlash('success','Your file has been uploaded');
            $students = $studentRepository->findAll();
            foreach ($students as $student){
                $entityManager->remove($student);
            }
            if (($fp = fopen("uploads/csv/users/" . $csvFile->getCsv(), "r"))) {
                $line = 0;
                while (($row = fgetcsv($fp))) {
                    $line ++;
                    if($line === 1 ) {
                        foreach ($row as $key => $label) {
                           switch ($label) {
                               case 'firstname':
                                   $keyFirstname = $key;
                                   break;
                               case 'lastname':
                                   $KeyLastname = $key;
                                   break;
                               case 'wilder_email':
                                   $keyEmail = $key;
                                   break;
                           }
                        }
                    } else{
                        $student = new Student();
                        $student->setFirstname($row[$keyFirstname]);
                        $student->setLastname($row[$KeyLastname]);
                        $student->setEmail($row[$keyEmail]);
                        $student->setInstructor($this->getUser());
                        $otherStudent = $studentRepository->findOneBy(['firstname'=>$student->getFirstname()]);
                        if($otherStudent) {
                            $lettersNewStudentLastname = str_split($student->getLastname());
                            $lettersOtherStudentLastname = str_split($otherStudent->getLastname());
                            $maxIteration = min(count($lettersNewStudentLastname), count($lettersOtherStudentLastname));
                            $extraNewName = $lettersNewStudentLastname[0];
                            $extraOtherName = $lettersOtherStudentLastname[0];
                            $i = 1;
                            while($lettersOtherStudentLastname[$i] === $lettersNewStudentLastname[$i] && $i <= $maxIteration) {
                                $extraNewName .= $lettersNewStudentLastname[$i];
                                $extraOtherName .= $lettersOtherStudentLastname[$i];
                                $i++;
                            }
                            $extraNewName .= $lettersNewStudentLastname[$i];
                            $extraOtherName .= $lettersOtherStudentLastname[$i];
                            $otherStudent->setDisplayName($otherStudent->getFirstname() . "." .$extraOtherName);
                            $student->setDisplayName($student->getFirstname() . "." .$extraNewName);
                        } else {
                            $student->setDisplayName($student->getFirstname());
                        }
                        $entityManager->persist($student);
                    }
                    $entityManager->flush();
                }
                fclose($fp);

            }

        }
        return $this->render('student/index.html.twig', [
            'students' => $studentRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/new", name="student_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager, StudentRepository $studentRepository): Response
    {
        $student = new Student();
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $otherStudent = $studentRepository->findOneBy(['firstname'=>$student->getFirstname()]);
            if($otherStudent) {
                $lettersNewStudentLastname = str_split($student->getLastname());
                $lettersOtherStudentLastname = str_split($otherStudent->getLastname());
                $maxIteration = min(count($lettersNewStudentLastname), count($lettersOtherStudentLastname));
                $extraNewName = $lettersNewStudentLastname[0];
                $extraOtherName = $lettersOtherStudentLastname[0];
                $i = 1;
                while($lettersOtherStudentLastname[$i] === $lettersNewStudentLastname[$i] && $i <= $maxIteration) {
                    $extraNewName .= $lettersNewStudentLastname[$i];
                    $extraOtherName .= $lettersOtherStudentLastname[$i];
                    $i++;
                }
                    $extraNewName .= $lettersNewStudentLastname[$i];
                    $extraOtherName .= $lettersOtherStudentLastname[$i];
                $otherStudent->setDisplayName($otherStudent->getFirstname() . "." .$extraOtherName);
                $student->setDisplayName($student->getFirstname() . "." .$extraNewName);
            } else {
                $student->setDisplayName($student->getFirstname());
            }
            $student->setInstructor($this->getUser());
            $entityManager->persist($student);
            $entityManager->flush();

            return $this->redirectToRoute('student_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('student/new.html.twig', [
            'student' => $student,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="student_show", methods={"GET"})
     */
    public function show(Student $student): Response
    {
        return $this->render('student/show.html.twig', [
            'student' => $student,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="student_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Student $student, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('student_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('student/edit.html.twig', [
            'student' => $student,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="student_delete", methods={"POST"})
     */
    public function delete(Request $request, Student $student, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$student->getId(), $request->request->get('_token'))) {
            $entityManager->remove($student);
            $entityManager->flush();
        }

        return $this->redirectToRoute('student_index', [], Response::HTTP_SEE_OTHER);
    }
}
