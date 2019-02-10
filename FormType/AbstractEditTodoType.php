<?php

namespace Neo\Bundle\TodoBundle\FormType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

abstract class AbstractEditTodoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'disabled' => true,
                'attr' => [
                    'class' => 'form-control',
                    'title' => 'Task name',
                ]
            ])
            ->add('due_date', DateTimeType::class, [
                'disabled' => true,
                'attr' => [
                    'title' => 'Due date',
                ]
            ])
            ->add('description', TextareaType::class, [
                'required' => true,
                'constraints' => [
                    new NotNull(),
                    new NotBlank(),
                    new Length(['min' => '3', 'max' => 255]),
                ],
                'attr' => [
                    'class' => 'form-control',
                    'title' =>  'Enter the Description',
                ]
            ])
            ->add('Update', SubmitType::class, ['attr' => [
                'class' => 'btn btn-success form-control',
                'style' => 'margin-top:10px;',
                'title' => 'Update description',
            ]])
        ;
    }
}
