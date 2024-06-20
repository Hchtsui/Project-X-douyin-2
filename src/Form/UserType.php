<?php
// src/Form/UserType.php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options): void
{
$builder
->add('email', EmailType::class)
->add('roles', ChoiceType::class, [
'choices' => [
'Admin' => 'ROLE_ADMIN',
'Employee' => 'ROLE_EMPLOYEE',
'User' => 'ROLE_USER',
],
'multiple' => true,
'expanded' => true,
])
->add('password', PasswordType::class, [
'required' => $options['is_new'],
]);
}

public function configureOptions(OptionsResolver $resolver): void
{
$resolver->setDefaults([
'data_class' => User::class,
'is_new' => false,
]);
}
}
