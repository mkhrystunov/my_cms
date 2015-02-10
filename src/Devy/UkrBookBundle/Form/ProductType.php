<?php

namespace Devy\UkrBookBundle\Form;

use Doctrine\ORM\EntityRepository;
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
            ->add('is_active', 'checkbox', [
                'required' => false,
                'attr' => [
                    'checked' => true,
                ],
            ])
            ->add('price', 'money')
            ->add('Brand')
            ->add('Category', 'entity', [
                'class' => 'DevyUkrBookBundle:Category',
                'required' => true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->where('c.is_active = true');
                },
            ])
            ->add('page_title', 'text', [
                'required' => false,
                'attr' => [
                    'placeholder' => 'Make sure that your title is clear, and contains many of the keywords within the page itself.',
                ]
            ])
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
            ->add('image', new FileType(), [
                'data_class' => 'Devy\UkrBookBundle\Entity\File'
            ])
            ->add('ProductAttributes', 'collection', [
                'type' => new ProductAttributeType(),
                'by_reference' => false,
                'allow_add' => true,
                'allow_delete' => true,
            ])
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Devy\UkrBookBundle\Entity\Product'
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'devy_ukrbookbundle_product';
    }
}
