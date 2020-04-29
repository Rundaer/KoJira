<?php

namespace App\Controller;

use App\Entity\Worktime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class WorktimeController extends AbstractController
{
    /**
     * @Route("/worktime", name="worktime_index")
     */
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $worktimes = $entityManager->getRepository(Worktime::class)->findAllExtend();

        return $this->render('worktime/index.html.twig', [
            'worktimes' => $worktimes,
        ]);
    }
}
