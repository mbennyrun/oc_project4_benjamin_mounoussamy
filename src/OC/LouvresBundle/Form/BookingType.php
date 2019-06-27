<?php

namespace OC\LouvresBundle\Form;

use OC\LouvresBundle\Entity\Booking;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('booking_date', DateType::class, [
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy'
            ])
            ->add('type', ChoiceType::class, array(
                    'choices' => array(
                        'Journée' => Booking::TYPE_DAY,
                        'Demi-journée' => Booking::TYPE_HALF_DAY,
                    ),
                )
            )
            ->add('tickets_number', IntegerType::class)
            ->add('tickets', CollectionType::class, array(
                    'entry_type' => TicketType::class,
                    'allow_add' => true,
                    'allow_delete' => true
                )
            )
            ->add('buy', SubmitType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Booking::class
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
