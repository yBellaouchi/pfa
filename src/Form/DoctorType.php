<?php

namespace App\Form;

use App\Entity\Doctor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DoctorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Login')
            ->add('Password')
            ->add('Cin')
            ->add('roles')
            ->add('FirstName')
            ->add('LastName')
            ->add('Telelphone')
            ->add('speciality')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Doctor::class,
        ]);
    }
}
