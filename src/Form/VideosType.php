<?php
// src/Form/VideosType.php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\Videos;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VideosType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options): void
{
$builder
->add('name')
->add('description')
->add('url')
->add('tag', ChoiceType::class, [
'choices' => [
'#All' => '#All',
'#Funny' => '#Funny',
'#Educational' => '#Educational',
],
])
->add('categories', EntityType::class, [
'class' => Categories::class,
'choice_label' => 'name',
'multiple' => true,
'expanded' => true,
]);
}

public function configureOptions(OptionsResolver $resolver): void
{
$resolver->setDefaults([
'data_class' => Videos::class,
]);
}
}
