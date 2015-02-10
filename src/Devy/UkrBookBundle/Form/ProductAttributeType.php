<?php

namespace Devy\UkrBookBundle\Form;


use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductAttributeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Attribute', 'entity', [
                'class' => 'DevyUkrBookBundle:Attribute',
                'required' => true,
                'query_builder' => function (EntityRepository $repository) {
                    return $repository->createQueryBuilder('a')
                        ->where('a.is_active = true');
                },
            ])
            ->add('value');
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Devy\UkrBookBundle\Entity\ProductAttribute'
        ]);
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'devy_ukrbookbundle_productattribute';
    }
}
