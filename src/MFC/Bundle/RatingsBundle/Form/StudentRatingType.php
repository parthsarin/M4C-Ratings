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
                ),
                'choices' => array(
                    'before' => 'Before my quiz or exam.',
                    'after' => 'After my quiz or exam.',
                ),
                'label' => '1. When are you evaluating?',
                'expanded' => true
            ))
            ->add('learnt', 'choice', array(
                'attr' => array(
                    'class' => 'btn-group',
                ),
                'multiple' => false,
                'expanded' => true,
                'choices' => array(
                    '1' => '<i class="fa fa-star"></i>',
                    '2' => '<i class="fa fa-star"></i><i class="fa fa-star"></i>',
                    '3' => '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>',
                    '4' => '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>',
                    '5' => '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>',
                ),
                'label' => '2. How much did you learn from this maplet? (<i class="fa fa-star"></i> = very little, <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> = a lot)',
            ))
            ->add('usefulPast', 'choice', array(
                'attr' => array(
                ),
                'multiple' => false,
                'expanded' => true,
                'choices' => array(
                    '1' => '<i class="fa fa-star"></i>',
                    '2' => '<i class="fa fa-star"></i><i class="fa fa-star"></i>',
                    '3' => '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>',
                    '4' => '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>',
                    '5' => '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>',
                ),
                'label' => '3. How useful do you think this maplet was on your test? (<i class="fa fa-star"></i> = very little, <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> = a lot)',
            ))
            ->add('usefulFuture', 'choice', array(
                'attr' => array(
                ),
                'multiple' => false,
                'expanded' => true,
                'choices' => array(
                    '1' => '<i class="fa fa-star"></i>',
                    '2' => '<i class="fa fa-star"></i><i class="fa fa-star"></i>',
                    '3' => '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>',
                    '4' => '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>',
                    '5' => '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>',
                ),
                'label' => '3. How useful do you think this maplet will be on your test? (<i class="fa fa-star"></i> = very little, <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> = a lot)',
            ))
            ->add('comments', 'textarea', array(
                'label' => 'Additional Comments:',
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
