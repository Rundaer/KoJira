<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Task;
use App\Form\ProjectType;
use App\Form\TaskType;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ProjectController extends AbstractController
{
    /**
     * @Route("/project", name="project_index")
     * 
     * @return Response
     */
    public function indexAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $projects = $entityManager->getRepository(Project::class)->findAll();

        return $this->render('project/index.html.twig', [
            'projects' => $projects,
        ]);
    }

    /**
     * Add project
     *
     * @Route("/project/add", name="project_add")
     *
     * @param Request $request
     *
     * @return Response
     * @throws Exception
     */
    public function addAction(Request $request)
    {
        $project = new Project();

        $form = $this->createForm(ProjectType::class, $project);

        if ($request->isMethod("post")){
            $form->handleRequest($request);

            $project->setCreatedAt(new \Datetime("now"));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($project);
            $entityManager->flush();

            $this->addFlash("success", "Project created");

            return $this->redirectToRoute("project_add");
        }
        return $this->render("project/add.html.twig", ["form" => $form->createView()]);
    }

    /**
     * @Route("/project/edit/{id}", name="project_edit")
     *
     * @param Request $request
     * @param Project $project
     *
     * @return RedirectResponse|Response
     */
    public function editAction(Request $request, Project $project)
    {

        $form = $this->createForm(ProjectType::class, $project);

        if ($request->isMethod("post")) {
            $form->handleRequest($request);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($project);
            $entityManager->flush();

            $this->addFlash("success", "Project has been updated");

            return $this->redirectToRoute("project_index", ["id" => $project->getId()]);
        }

        return $this->render("project/edit.html.twig", ["form" => $form->createView()]);
    }

    /**
     * @Route("/project/details/{id}", name="project_details")
     *
     * @param Project $project
     * 
     * @return Response
     */
    public function detailsAction(Project $project)
    {
        return $this->render(
            "project/details.html.twig",
            [
                "project" => $project
            ]
        );
    }

    /**
     * @Route("/project/delete/{id}", name="project_delete")
     *
     * @param Project $project
     *
     * @return RedirectResponse
     */
    public function deleteAction(Project $project)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($project);
        $entityManager->flush();

        $this->addFlash("success", "Project {$project->getName()} has been deleted");

        return $this->redirectToRoute("project_index");
    }

    /**
     * @Route("/project/addTask/{id}", name="project_addTask")
     *
     * @param Request $request
     * @param Project $project
     *
     * @return RedirectResponse|Response
     * @throws Exception
     */
    public function addTask(Request $request, Project $project)
    {
        $this->denyAccessUnlessGranted("ROLE_USER");

        $task = new Task();
        $taskForm = $this->createForm(TaskType::class, $task);


        if ($request->isMethod("post")){

            $taskForm->handleRequest($request);

            if($taskForm->isValid()){

                $entityManager = $this->getDoctrine()->getManager();

                $task
                    ->setCreatedAt(new \DateTime("now"))
                    ->setUpdatedAt(new \DateTime("now"))
                    ->setStatus(TASK::TASK_ACTIVE)
                    ->setProject($project)
                    ->setOwner($this->getUser());

                $entityManager->persist($task);
                $entityManager->flush();

                $this->addFlash("success", "Task added");

                return $this->redirectToRoute("project_details", ['id' => $project->getId()] );
            } else {
                $this->addFlash("error", "Error with adding task");

            }

        }

        return $this->render("task/add.html.twig", ["taskForm" => $taskForm->createView()]);
    }

    /**
     * @Route("/project/deleteTask/{id}", name="project_deleteTask")
     */
    public function deleteTask(Task $task)
    {
        $project = $task->getProject();

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($task);
        $entityManager->flush();

        $this->addFlash("success", "Task has been deleted");

        return $this->redirectToRoute("project_details", ["id" => $project->getId()]);
    }
    
}
