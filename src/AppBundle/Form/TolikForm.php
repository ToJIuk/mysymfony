<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TolikForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('old')
            ->add('someText')
            ->add('date', null, array(
                'placeholder' => array(
                    'year' => 'Год', 'month' => 'Месяц', 'day' => 'День'
                )
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Pages'
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_tolik_form';
    }
}
