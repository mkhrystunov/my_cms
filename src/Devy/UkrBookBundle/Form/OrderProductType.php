<?php

namespace Devy\UkrBookBundle\Form;


use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class OrderProductType
 * @package Devy\UkrBookBundle\Form
 */
class OrderProductType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Product', 'entity', [
                'class' => 'DevyUkrBookBundle:Product',
                'required' => true,
                'query_builder' => function (EntityRepository $repository) {
                    return $repository->createQueryBuilder('p')
                        ->where('p.is_active = true');
                },
            ])
            ->add('amount', 'integer', [
                'attr' => [
                    'min' => 1,
                    'value' => 1,
                ],
            ]);
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Devy\UkrBookBundle\Entity\OrderProduct'
        ]);
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'devy_ukrbookbundle_orderproduct';
    }
}
