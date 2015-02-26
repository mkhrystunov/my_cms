<?php

namespace Devy\UkrBookBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class MessageType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subject')
            ->add('message', 'textarea', [
                'attr' => [
                    'pattern' => '.{15,}',
                    'title' => '15 characters minimum',
                ]
            ])
            ->add('name')
            ->add('phone')
            ->add('email');
    }

    /**
     * @param array $options
     * @return array
     */
    public function getDefaultOptions(array $options)
    {
        return [
            'data_class' => 'Devy\UkrBookBundle\Entity\Message',
        ];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'devy_ukrbookbundle_message';
    }
}
