<?php

namespace OC\LouvresBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class bookingType extends AbstractType
{
   public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('booking_date', TextType::class)
      ->add('type',         ChoiceType::class, array(
          'choices'  => array(
              'Journée' => 'Journée',
              'Demi-journée' => 'Demi-journée',
              ),
          )
        )
      ->add('tickets_number', IntegerType::class)
      ->add('tickets',      CollectionType::class, array(
          'entry_type'   => ticketsType::class,
          'allow_add'    => true,
          'allow_delete' => true
          )
        )
      ->add('buy', SubmitType::class);
  }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OC\LouvresBundle\Entity\booking'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'oc_louvresbundle_booking';
    }

}
