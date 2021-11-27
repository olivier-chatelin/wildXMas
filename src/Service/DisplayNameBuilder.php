<?php

namespace App\Service;

use App\Entity\Student;
use App\Repository\StudentRepository;

class DisplayNameBuilder
{
    private StudentRepository $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function create(Student $newStudent)
    {
        $otherStudent = $this->studentRepository->findOneBy(['firstname'=>$newStudent->getFirstname()]);
        if ($otherStudent) {
            $lettersNewStudentLastname = str_split($newStudent->getLastname());
            $lettersOtherStudentLastname = str_split($otherStudent->getLastname());
            $maxIteration = min(count($lettersNewStudentLastname), count($lettersOtherStudentLastname));
            $extraNewName = "";
            $extraOtherName = "";
            $i = 0;
            while ($lettersOtherStudentLastname[$i] === $lettersNewStudentLastname[$i] && $i <= $maxIteration) {
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
}