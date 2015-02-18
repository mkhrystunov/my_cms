<?php

namespace Devy\UkrBookBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class ReviewType
 * @package Devy\UkrBookBundle\Form
 */
class ReviewType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('review', 'text', [
                'required' => false,
                'attr' => [
                    'placeholder' => 'Leave your review here',
                    'pattern' => '.{15,}',
                    'title' => '15 characters minimum',
                ],
            ])
            ->add('name', 'text', [
                'required' => false,
                'attr' => [
                    'placeholder' => 'Your name',
                ],
            ])
            ->add('score', 'hidden', [
                'attr' => [
                    'value' => 3,
                ],
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
            'data_class' => 'Devy\UkrBookBundle\Entity\Review'
        ];
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'devy_ukrbookbundle_review';
    }
}
