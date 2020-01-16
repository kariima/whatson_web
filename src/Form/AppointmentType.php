<?php

namespace App\Form;

use App\Entity\Appointment;
use App\Entity\Customer;
use App\Entity\Place;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AppointmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date')
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => function($user) {
                    return $user->getid() . " " . $user->getLastname() . " " . $user->getFirstname();
                }
            ])
            ->add('customer', EntityType::class, [
                'class' => Customer::class,
                'choice_label' => function($customer) {
                    return $customer->getid() . " " . $customer->getLastname() . " " . $customer->getFirstname();
                }
            ])
            ->add('place', EntityType::class, [
                'class' => Place::class,
                'choice_label' => function($place) {
                    return $place->getId() . " " . $place->getName();
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Appointment::class,
        ]);
    }
}
