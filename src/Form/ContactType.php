<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'First Name',
                'attr' => [
                    'placeholder' => 'Enter your frist name'
                ]
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Last Name',
                'attr' => [
                    'placeholder' => 'Enter your last name'
                ]
            ])
            ->add('contact', TextType::class, [
                'label' => 'Mobile',
                'help' => 'Mobile number is only for official communicaiton, We consider this number as also your whatsup number',
                'attr' => [
                    'placeholder' => 'Enter your mobile'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => [
                    'placeholder' => 'Enter your email'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
