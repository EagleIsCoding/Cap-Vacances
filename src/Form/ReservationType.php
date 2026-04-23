<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Reservation;
use App\Entity\Studio;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
    $builder
->add('dateDebutReservation', null, [
        'widget' => 'single_text',
        'attr' => ['class' => 'datepicker'], 
    ])
    ->add('dateFinReservation', null, [
        'widget' => 'single_text',
        'attr' => ['class' => 'datepicker'], 
    ])
        ->add('nbPersonnesReservation', null, [
            'label' => 'Nombre de vacanciers'
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}