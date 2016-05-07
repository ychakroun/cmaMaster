<?php

namespace CmaAdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use CmaAdminBundle\Entity\Newsletter;

class NewsletterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subject',null,array(
                'label' => 'Subject',
                'required' => true,
                'translation_domain' => 'FOSUserBundle',
                'attr' => array('class' => 'titreOeuvre')
            ))
            ->add('content',TextareaType::class,array(
                'required'=>false,
                'data' => '',
                'attr'=>array('class'=>'textarea')
                ));
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CmaAdminBundle\Entity\Newsletter'
        ));
    }
}
