<?php

namespace CmaUserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

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
            ->add('day', NumberType::class,array('label' => 'form.estimate.day','required' => true,'translation_domain' => 'FOSUserBundle'))
            ->add('deliveryAdress',null,array('label' => 'form.estimate.deliveryAdress','required' => true,'translation_domain' => 'FOSUserBundle'))
            ->add('budget',MoneyType::class,array('label' => 'form.estimate.budget','required' => false,'translation_domain' => 'FOSUserBundle'))
            ->add('medium',null,array('label' => 'form.estimate.medium','required' => false,'translation_domain' => 'FOSUserBundle'))
            ->add('technics',null,array('label' => 'form.estimate.technics','required' => false,'translation_domain' => 'FOSUserBundle'))
            ->add('tools',null,array('label' => 'form.estimate.tools','required' => false,'translation_domain' => 'FOSUserBundle'))
            ->add('width',null,array('label' => 'form.estimate.width','required' => false,'translation_domain' => 'FOSUserBundle'))
            ->add('height',null,array('label' => 'form.estimate.height','required' => false,'translation_domain' => 'FOSUserBundle'))
            ->add('isPublic')
            ->add('image1',ImageType::class,array('required' => false,'label' => false, 'translation_domain' => 'FOSUserBundle'))
            ->add('image2',ImageType::class,array('required' => false,'label' => false, 'translation_domain' => 'FOSUserBundle'))
            ->add('image3',ImageType::class,array('required' => false,'label' => false, 'translation_domain' => 'FOSUserBundle'))

        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CmaUserBundle\Entity\Estimate'
        ));
    }
}
