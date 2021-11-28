<?php

namespace App\Service;

use App\Entity\Student;
use App\Repository\StudentRepository;
use Doctrine\Common\Collections\Collection;

class DisplayNameBuilder
{
    private StudentRepository $studentRepository;
    private Collection $students;

    public function __construct(StudentRepository $studentRepository, Collection $students)
    {
        $this->studentRepository = $studentRepository;
        $this->students = $students;
    }

    public function create(Student $newStudent)
    {
        $otherStudent = $this->findOtherStudent($newStudent, $this->students);
//        $otherStudent = $this->studentRepository->findOneBy(['firstname'=>$newStudent->getFirstname()]);
        if ($otherStudent) {
            $lettersNewStudentLastname = str_split($newStudent->getLastname());
            $lettersOtherStudentLastname = str_split($otherStudent->getLastname());
            $maxIteration = min(count($lettersNewStudentLastname), count($lettersOtherStudentLastname));
            $extraNewName = "";
            $extraOtherName = "";
            $i = 0;
            while ($lettersOtherStudentLastname[$i] === $lettersNewStudentLastname[$i] && $i < $maxIteration -1) {
                $extraNewName .= $lettersNewStudentLastname[$i];
                $extraOtherName .= $lettersOtherStudentLastname[$i];
                $i++;
            }
            $extraNewName .= $lettersNewStudentLastname[$i];
            $extraOtherName .= $lettersOtherStudentLastname[$i];
            $otherStudent->setDisplayName($otherStudent->getFirstname() . "." . $extraOtherName);
            $newStudent->setDisplayName($newStudent->getFirstname() . "." . $extraNewName);
        } else {
            $newStudent->setDisplayName($newStudent->getFirstname());
        }
    }

    public function findOtherStudent(Student $newStudent, Collection $students): ?Student
    {
        foreach ($students as $student){
            if($student->getFirstname() === $newStudent->getFirstname()){
                return $student;
            }

        }
        return null;

    }
}