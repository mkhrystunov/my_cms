<?php

namespace Devy\UkrBookBundle\Form;

use Devy\UkrBookBundle\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class OrderTypeAdmin
 * @package Devy\UkrBookBundle\Form
 */
class OrderTypeAdmin extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('email', 'email')
            ->add('phone')
            ->add('shipping_address_city')
            ->add('shipping_address_details')
            ->add('status', 'choice', [
                'choices' => Order::getStatusChoicesArray(),
            ])
            ->add('OrderProduct', 'collection', [
                'type' => new OrderProductType(),
                'by_reference' => false,
                'allow_add' => true,
                'allow_delete' => true,
            ])
        ;
    }

    /**
     * @param array $options
     * @return array
     */
    public function getDefaultOptions(array $options)
    {
        return [
            'data_class' => 'Devy\UkrBookBundle\Entity\Order'
        ];
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'devy_ukrbookbundle_order';
    }
}
