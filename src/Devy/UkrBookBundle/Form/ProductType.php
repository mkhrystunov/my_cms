<?php

namespace Devy\UkrBookBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('description_full')
            ->add('code')
            ->add('is_active', 'checkbox', array(
                'attr' => array(
                    'checked' => true,
                ),
            ))
            ->add('price', 'integer')
            ->add('Brand')
            ->add('Category', 'entity', array(
                'class' => 'DevyUkrBookBundle:Category',
                'required' => true,
            ))
            ->add('ProductAttributes', 'collection', array(
                'type' => new ProductAttributeType(),
                'by_reference' => false,
                'allow_add' => true,
            ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Devy\UkrBookBundle\Entity\Product'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'devy_ukrbookbundle_product';
    }
}
