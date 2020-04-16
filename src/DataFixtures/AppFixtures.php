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
        $project_6 = new Project();

        $project_1
            ->setName("KoJira 1.0")
            ->setDescription("Przykładowy Opis")
            ->setCreatedAt(new \DateTime("now"))
            ->setExpiresAt(new \DateTime("+3 months"))
            ->setStatus(Project::STATUS_ACTIVE)
            ->setType(Project::TYPE_HOME);
        
        $project_2
            ->setName("KoJira 1.1")
            ->setDescription("Przykładowy Opis")
            ->setCreatedAt(new \DateTime("now"))
            ->setExpiresAt(new \DateTime("+3 months"))
            ->setStatus(Project::STATUS_ACTIVE)
            ->setType(Project::TYPE_WSIZ);
        
        $project_3
            ->setName("KoJira 1.2")
            ->setDescription("Przykładowy Opis")
            ->setCreatedAt(new \DateTime("now"))
            ->setExpiresAt(new \DateTime("+3 months"))
            ->setStatus(Project::STATUS_FINISHED)
            ->setType(Project::TYPE_WSIZ);
        
        $project_4
            ->setName("KoJira 1.3")
            ->setDescription("Przykładowy Opis")
            ->setCreatedAt(new \DateTime("now"))
            ->setExpiresAt(new \DateTime("+3 months"))
            ->setStatus(Project::STATUS_ACTIVE)
            ->setType(Project::TYPE_WORK);
        
        $project_5
            ->setName("KoJira 1.4")
            ->setDescription("Przykładowy Opis")
            ->setCreatedAt(new \DateTime("now"))
            ->setExpiresAt(new \DateTime("+3 months"))
            ->setStatus(Project::STATUS_ACTIVE)
            ->setType(Project::TYPE_HOME);
        
        $project_6
            ->setName("KoJira 1.5")
            ->setDescription("Przykładowy Opis")
            ->setCreatedAt(new \DateTime("now"))
            ->setExpiresAt(new \DateTime("+3 months"))
            ->setStatus(Project::STATUS_ACTIVE)
            ->setType(Project::TYPE_WSIZ);
        
        $manager->persist($project_1);
        $manager->persist($project_2);
        $manager->persist($project_3);
        $manager->persist($project_4);
        $manager->persist($project_5);
        $manager->persist($project_6);
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
