<?php

namespace App\Form;

use App\Entity\Locker;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LockerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('number', null,[
                'label' => 'form.number',
            ])
            ->add('isEmpty', CheckboxType::class,[
                'label' => 'global.empty',
                'attr' => ['checked'  => 'checked'],
                'disabled' => 'true',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Locker::class,
        ]);
    }
}
