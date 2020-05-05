<?php

namespace App\Controller;

use App\Entity\Task;
use App\Entity\Worktime;
use App\Form\WorktimeType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

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

    /**
     * @Route("/worktime/add", name="worktime_add")
     * 
     * @param Request $request
     */
    public function addAction(Request $request)
    {
        $this->denyAccessUnlessGranted("ROLE_USER");
        $worktime = new Worktime();

        $form = $this->createForm(WorktimeType::class, $worktime);

        if ($request->isMethod("post")){
            $form->handleRequest($request);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($worktime);
            $entityManager->flush();

            $this->addFlash("success", "Worktime added");

            return $this->redirectToRoute("worktime_index");
        }
        return $this->render("worktime/add.html.twig", ["form" => $form->createView()]);
    }


}
