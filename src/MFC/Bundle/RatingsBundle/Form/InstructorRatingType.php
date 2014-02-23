<?php

namespace MFC\Bundle\RatingsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class InstructorRatingType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('methodUsed', 'choice', array(
                'choices' => array(
                    'InClassDemo' => 'As an in-class demo.',
                    'LabActivity' => 'As a lab activity.',
                    'Homework' => 'As homework.',
                ),
                'multiple' => true,
                'expanded' => true,
                'attr' => array(
                ),
                'label' => '1. How are you using this maplet in your class? (Check 0, 1, 2, or 3.)'
            ))
            ->add('methodUsedOther', 'text', array(
                'attr' => array(
                    'class' => 'form-control',
                ),
                'label' => 'Other'
            ))
            ->add('skillsDeveloped', 'choice', array(
                'choices' => array(
                    'Intuition' => 'Intuition',
                    'Computation' => 'Computation',
                    'Vizualization' => 'Vizualization',
                ),
                'multiple' => true,
                'expanded' => true,
                'attr' => array(
                ),
                'label' => '2. What skills does this maplet help develop? (Check 0, 1, 2, or 3.)'
            ))
            ->add('skillsDevelopedOther', 'text', array(
                'attr' => array(
                    'class' => 'form-control',
                ),
                'label' => 'Other'
            ))
            ->add('rating', 'choice', array(
                'attr' => array(
                    'class' => 'form-control',
                ),
                'multiple' => false,
                'expanded' => true,
                'choices' => array(
                    '1' => '*',
                    '2' => '**',
                    '3' => '***',
                    '4' => '****',
                    '5' => '*****',
                ),
                'label' => '3. Please rate the overall value of this maplet. (* = very poor, ***** = very good)'
            ))
            ->add('comments', 'textarea', array(
                'attr' => array(
                    'class' => 'form-control',
                ),
                'label' => 'Additional Comments:',
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MFC\Bundle\RatingsBundle\Entity\InstructorRating'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mfc_bundle_ratingsbundle_instructorrating';
    }
}
