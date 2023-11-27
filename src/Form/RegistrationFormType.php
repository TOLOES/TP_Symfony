<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('login', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'user.login.not_blank']),
                    new Length([
                        'min' => 3,
                        'max' => 255,
                        'minMessage' => 'user.login.length.min',
                        'maxMessage' => 'user.login.length.max',
                    ]),
                ],
                'label' => 'login',
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'constraints' => [
                    new Regex([
                        'pattern' => '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/',
                        'message' => 'user.password.regex',
                    ]),
                ],
                'first_options' => ['label' => 'pass'],
                'second_options' => ['label' => 'confirmPassword'],
                'invalid_message' => 'user.password.mismatch',
            ])
            ->add('submit', SubmitType::class, ['label' => 'submit']);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'csrf_protection' => false,
        ]);
    }
}