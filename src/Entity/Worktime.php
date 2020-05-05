<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WorktimeRepository")
 */
class Worktime
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="time")
     */
    private $timeSpend;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Task", inversedBy="worktimes")
     */
    private $Task;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTimeSpend(): ?\DateTimeInterface
    {
        return $this->timeSpend;
    }

    public function setTimeSpend(\DateTimeInterface $timeSpend): self
    {
        $this->timeSpend = $timeSpend;

        return $this;
    }

    public function getTask(): ?Task
    {
        return $this->Task;
    }

    public function setTask(?Task $Task): self
    {
        $this->Task = $Task;

        return $this;
    }
}
