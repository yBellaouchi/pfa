<?php

namespace App\Form;

use App\Entity\Nurse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
// use Symfony\Component\Form\Extension\Core\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NursePlanningType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

        ->add('FullName',EntityType::class,array('class'=>'App\Entity\Nurse','choice_label' => 'FullName'))
        ->add('Group', ChoiceType::class, [
            'label' => 'Category',
            'placeholder' => 'Groupes',
            'choices' => [
                'morning group' => 'morning group',
                'evening group' => 'evening group',
                'group of the night' => 'group of the night',
            ],
        ])
       
      ;
    }

    // public function configureOptions(OptionsResolver $resolver): void
    // {
    //     $resolver->setDefaults([
    //         'data_class' => Nurse::class,
    //     ]);
    // }
}
