<?php

namespace Devy\UkrBookBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AttributeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('code')
            ->add('mode', 'choice', array(
                'choices' => array(1 => 'Text', 2 => 'Choice'),
            ))
            ->add('defaults')
            ->add('is_active');
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Devy\UkrBookBundle\Entity\Attribute'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'devy_ukrbookbundle_attribute';
    }
}
