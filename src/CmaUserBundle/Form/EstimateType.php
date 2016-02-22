<?php

namespace CmaUserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EstimateType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',null,array('label' => 'form.estimate.title','required' => true,'translation_domain' => 'FOSUserBundle'))
            ->add('orientation',ChoiceType::class , array(
                'choices' => array(
                    'form.estimate.orientation.true'=>true,
                    'form.estimate.orientation.false'=>false,
                    ),
                'required' => false,
            ))
            ->add('description',null,array('label' => 'form.estimate.description','required' => false,'label' => false,'translation_domain' => 'FOSUserBundle'))
            ->add('day', NumberType::class,array('label' => 'form.estimate.day','required' => false,'translation_domain' => 'FOSUserBundle'))
            ->add('deliveryAdress',null,array('label' => 'form.estimate.deliveryAdress','required' => true,'translation_domain' => 'FOSUserBundle'))
            ->add('budget',MoneyType::class,array('label' => 'form.estimate.budget','required' => false,'translation_domain' => 'FOSUserBundle'))
            ->add('medium',null,array('label' => 'form.estimate.medium','required' => false,'translation_domain' => 'FOSUserBundle'))
            ->add('technics',null,array('label' => 'form.estimate.technics','required' => false,'translation_domain' => 'FOSUserBundle'))
            ->add('tools',null,array('label' => 'form.estimate.tools','required' => false,'translation_domain' => 'FOSUserBundle'))
            ->add('width',null,array('label' => 'form.estimate.width','required' => false,'translation_domain' => 'FOSUserBundle'))
            ->add('height',null,array('label' => 'form.estimate.height','required' => false,'translation_domain' => 'FOSUserBundle'))
            ->add('image1',ImageType::class,array('required' => false,'label' => false, 'translation_domain' => 'FOSUserBundle'))
            ->add('image2',ImageType::class,array('required' => false,'label' => false, 'translation_domain' => 'FOSUserBundle'))
            ->add('image3',ImageType::class,array('required' => false,'label' => false, 'translation_domain' => 'FOSUserBundle'))
            ->add('condition', CheckboxType::class,array("mapped" => false,'required' => true,'label' => 'form.estimate.condition', 'translation_domain' => 'FOSUserBundle'))
            ->add('save', SubmitType::class, array(
                    'attr' => array("mapped" => false,'class' => 'buttonAction','value'=>'form.estimate.save'),
                    'translation_domain' => 'FOSUserBundle'

                ))
            ->add('submit', SubmitType::class, array(
                    'attr' => array("mapped" => false,'class' => 'buttonAction','value'=>'form.estimate.save'),
                    'translation_domain' => 'FOSUserBundle'
                ))

        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CmaUserBundle\Entity\Estimate',
            'allow_extra_fields' => true
        ));
    }
}
