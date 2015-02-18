<?php

namespace Devy\UkrBookBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BrandType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('is_active')
            ->add('meta_description', 'textarea', [
                'required' => false,
                'attr' => [
                    'placeholder' => 'Make sure it uses keywords found within the page itself.',
                ]
            ])
            ->add('meta_keywords', 'textarea', [
                'required' => false,
                'attr' => [
                    'placeholder' => 'Don\'t repeat keywords over and over in a row. Rather, put in keyword phrases.',
                ]
            ])
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Devy\UkrBookBundle\Entity\Brand'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'devy_ukrbookbundle_brand';
    }
}
