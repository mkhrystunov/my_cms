<?php

namespace Devy\UkrBookBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class AboutPageType
 * @package Devy\UkrBookBundle\Form
 */
class ShopInfoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('address')
            ->add('email')
            ->add('phone')
        ;
    }

    /**
     * @param array $options
     * @return array
     */
    public function getDefaultOptions(array $options)
    {
        return [
            'data_class' => 'Devy\UkrBookBundle\Entity\ShopInfo'
        ];
    }
    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'devy_ukrbookbundle_shopinfo';
    }
}
