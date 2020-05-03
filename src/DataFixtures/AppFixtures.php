<?php

namespace App\DataFixtures;

use App\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $project_1 = new Project();
        $project_2 = new Project();
        $project_3 = new Project();
        $project_4 = new Project();
        $project_5 = new Project();

        $project_1
            ->setName("KoJira 1.0")
            ->setDescription("Web application for website")
            ->setCreatedAt(new \DateTime("3/22"))
            ->setExpiresAt(new \DateTime("5/22"))
            ->setStatus(Project::STATUS_ACTIVE)
            ->setType(Project::TYPE_WSIZ);
        
        $project_2
            ->setName("Dog house project")
            ->setDescription("Creating shelter for my dog 'Misza'")
            ->setCreatedAt(new \DateTime("5/22"))
            ->setExpiresAt(new \DateTime("+2 months"))
            ->setStatus(Project::STATUS_ACTIVE)
            ->setType(Project::TYPE_WSIZ);
        
        $project_3
            ->setName("Wedding!")
            ->setDescription("I am getting married")
            ->setCreatedAt(new \DateTime("1/1"))
            ->setExpiresAt(new \DateTime("11/14"))
            ->setStatus(Project::STATUS_ACTIVE)
            ->setType(Project::TYPE_HOME);
        
        $project_4
            ->setName("Brother Website")
            ->setDescription("Gatsby.js project for website")
            ->setCreatedAt(new \DateTime("now"))
            ->setExpiresAt(new \DateTime("+3 months"))
            ->setStatus(Project::STATUS_ACTIVE)
            ->setType(Project::TYPE_HOME);
        
        $project_5
            ->setName("Tree house")
            ->setDescription("Making secret base!")
            ->setCreatedAt(new \DateTime("6/5"))
            ->setExpiresAt(new \DateTime("+3 months"))
            ->setStatus(Project::STATUS_ACTIVE)
            ->setType(Project::TYPE_HOME);
        

        
        $manager->persist($project_1);
        $manager->persist($project_2);
        $manager->persist($project_3);
        $manager->persist($project_4);
        $manager->persist($project_5);

        $manager->flush();
    }
}
