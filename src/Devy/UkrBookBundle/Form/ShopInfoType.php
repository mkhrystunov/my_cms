<?php

namespace Devy\UkrBookBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

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
            ->add('geo')
            ->add('email')
            ->add('phone')
            ->add('metaDescription')
            ->add('metaKeywords')
        ;
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $form = $event->getForm();
            $form->add('description', 'textarea', [
                'attr' => [
                    'rows' => strlen($event->getData()->getDescription()) / 150 > 10 ?: 10,
                    'placeholder' => 'You can use HTML tags to format text',
                ]
            ]);
        });
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
