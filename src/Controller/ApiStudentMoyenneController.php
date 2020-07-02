<?php

namespace App\Controller;

use App\Repository\NoteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizableInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ApiStudentMoyenneController extends AbstractController
{
    /**
     * @Route("/api/student/{id_student}/moyenne", name="api_student_moyenne_index",methods={"GET"})
     */
    public function index(NoteRepository $noteRepository,int $id_student,NormalizerInterface $normalizer)
    {
        $notes = $noteRepository->findBy(array(
            "student" => $id_student
        ));

        $notesNormalises = $normalizer->normalize($notes);


        $total_note = 0.0;
        $nb_note = 0;

        foreach($notes as $note){
            $total_note = $total_note + $note->getValue();
            $nb_note++;
        }

        $moyenne_student = round($total_note/$nb_note,2);

        $json = json_encode([
            "notes" => $notesNormalises,
            "moyenne" => $moyenne_student
        ]);

        $response = new Response($json, 200, [
            "Content-Type" => "application/json"
        ]);

        return $response;
    }
    /**
     * @Route("/api/moyenne_all", name="api_moyenne_all_index",methods={"GET"})
     */
    public function moyenneAll(NoteRepository $noteRepository,NormalizerInterface $normalizer)
    {
        $notes = $noteRepository->findAll();

        $notesNormalises = $normalizer->normalize($notes);


        $total_note = 0.0;
        $nb_note = 0;

        foreach($notes as $note){
            $total_note = $total_note + $note->getValue();
            $nb_note++;
        }

        $moyenne_all = round($total_note/$nb_note,2);

        $json = json_encode([
            "notes" => $notesNormalises,
            "moyenne" => $moyenne_all
        ]);
        $response = new Response($json, 200, [
            "Content-Type" => "application/json"
        ]);

        return $response;
    }
}
