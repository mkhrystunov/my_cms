<?php

namespace Devy\UkrBookBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('is_active', 'checkbox', [
                'required' => false,
            ])
        ;
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $form = $event->getForm();
            $form->add('text', 'textarea', [
                'attr' => [
                    'rows' => strlen($event->getData()->getText()) / 150 > 10 ?: 10,
                    'placeholder' => 'You can use HTML tags to format text',
                ]
            ]);
        });
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Devy\UkrBookBundle\Entity\Post'
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'devy_ukrbookbundle_post';
    }
}
