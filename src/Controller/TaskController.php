<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Task;
use App\Form\TaskType;
use App\Form\TaskProjectType;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class TaskController extends AbstractController
{
    /**
     * @Route("/tasks", name="task_index")
     */
    public function indexAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $tasks = $entityManager->getRepository(Task::class)->findAll();

        return $this->render('task/index.html.twig', [
            'tasks' => $tasks,
        ]);
    }


    /**
     * @Route("/tasks/addTask", name="task_add")
     *
     * @param Request $request
     *
     * @return Response
     * @throws Exception
     */
    public function addTask(Request $request)
    {
        $this->denyAccessUnlessGranted(["ROLE_ADMIN","ROLE_USER"]);

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
                    ->setOwner($this->getUser());
                
                $entityManager->persist($task);
                $entityManager->flush();
    
                $this->addFlash("success", "Task added");
    
                return $this->redirectToRoute("task_index");
            } else {
                $this->addFlash("error", "Error with adding task");
    
            }
             
        }
        return $this->render("task/add.html.twig", ["taskForm" => $taskForm->createView()]);
    }

    /**
     * @Route("/tasks/addTaskProject/{id}", name="taskProject_add")
     *
     * @param Request $request
     * @param Project $project
     *
     * @return Response
     * @throws Exception
     */
    public function addTaskProject(Request $request, Project $project)
    {
        $this->denyAccessUnlessGranted(["ROLE_ADMIN","ROLE_USER"]);

        $task = new Task();
        $taskForm = $this->createForm(TaskProjectType::class, $task);

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
    
                $this->addFlash("success", "Task for project added");
    
                return $this->redirectToRoute("project_details", ['id'=>$project->getId()]);
            } else {
                $this->addFlash("error", "Error with adding task");
    
            }
             
        }
        return $this->render("task/add.html.twig", ["taskForm" => $taskForm->createView()]);
    }
}

