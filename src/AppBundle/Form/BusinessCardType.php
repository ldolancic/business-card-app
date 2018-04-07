<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BusinessCardType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, array(
                'required' => true,
                'trim' => true,
                'label' => 'First name'
            ))
            ->add('lastName', TextType::class, array(
                'required' => true,
                'trim' => true,
                'label' => 'Last name'
            ))
            ->add('company')
            ->add('position')
            ->add('phone')
            ->add('email')
            ->add('baseColor', ColorType::class, array(
                'required' => true,
                'trim' => true,
                'label' => 'Base color',
                'data' => '#ff0000'
            ))
            ->add('picture')
            ->add('submitBtn', SubmitType::class, array('label' => 'Submit'));;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\BusinessCard'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_businesscard';
    }


}
