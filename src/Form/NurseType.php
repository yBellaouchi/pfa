<?php

namespace App\Form;

use App\Entity\Nurse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType; 
use Symfony\Component\Form\Extension\Core\Type\EntityType; 
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NurseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('FullName',TextType::class)
            // ->add('LastName',TextType::class)
            ->add('Cin',TextType::class)           
            ->add('Gender', ChoiceType::class, [
                'label' => 'Gender',
                           'choices' => [
                    'Male' => 'Male',
                    'Female ' => 'Female',
                ],
            ])
            ->add('Tel',TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Nurse::class,
        ]);
    }
}
