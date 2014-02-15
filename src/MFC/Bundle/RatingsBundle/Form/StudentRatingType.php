<?php

namespace MFC\Bundle\RatingsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StudentRatingType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('timeEval', 'choice', array(
                'attr' => array(
                    'class' => 'form-control'
                ),
                'choices' => array(
                    'before' => 'Before',
                    'after' => 'After',
                ),
                'label' => 'When are you evaluating?'
            ))
            ->add('learnt', 'choice', array(
                'attr' => array(
                    'class' => 'form-control btn-group',
                    'data-toggle' => 'buttons-radio',
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
                'label' => 'How much did you learn from this maplet?',
            ))
            ->add('usefulPast', 'choice', array(
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
                'label' => 'How useful do you think this maplet was on your test?',
            ))
            ->add('usefulFuture', 'choice', array(
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
                'label' => 'How useful do you think this maplet will be on your test?',
            ))
            ->add('comments', 'textarea', array(
                'attr' => array(
                    'class' => 'form-control',
                )
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MFC\Bundle\RatingsBundle\Entity\StudentRating'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mfc_bundle_ratingsbundle_studentrating';
    }
}
