<?php

namespace App\Form;

use App\Entity\Project;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class AuctionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("name", TextType::class)
            ->add("description", TextareaType::class)
            ->add("expiresAt", DateType::class,[
                'data' => new \Datetime("+1 day"),
            ])
            ->add("status", ChoiceType::class, [
                'choices' => [
                    'active' => Project::STATUS_ACTIVE,
                    'finished' => Project::STATUS_FINISHED,
                ],
            ])
            ->add("type", ChoiceType::class, [
                'choices' => [
                    'home' => Project::TYPE_HOME,
                    'work' => Project::TYPE_WORK,
                    'wsiz' => Project::TYPE_WSIZ,
                ],
            ])
            ->add("submit", SubmitType::class);
    }

    public function configureOptions(\Symfony\Component\OptionsResolver\OptionsResolver $resolver)
    {
        $resolver->setDefaults(["data_class" => Project::class]);
    }
}