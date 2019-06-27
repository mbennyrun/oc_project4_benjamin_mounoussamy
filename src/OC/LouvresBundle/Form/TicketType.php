<?php

namespace OC\LouvresBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ticketsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('name',      TextType::class)
      ->add('first_name',     TextType::class)
      ->add('country',    CountryType::class)
      ->add('birth_date',   BirthdayType::class)
      ->add('reduce', CheckboxType::class);
  }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OC\LouvresBundle\Entity\Ticket'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'oc_louvresbundle_tickets';
    }


}
