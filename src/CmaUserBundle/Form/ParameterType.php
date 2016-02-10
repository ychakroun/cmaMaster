<?php

namespace CmaUserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ParameterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mailDevisAll',CheckboxType::class , array('label' => 'form.parameter.mail_devis_all', 'translation_domain' => 'FOSUserBundle'))
            ->add('mailDevisUser',CheckboxType::class , array('label' => 'form.parameter.mail_devis_user', 'translation_domain' => 'FOSUserBundle'))
            ->add('mailDevisCom',CheckboxType::class , array('label' => 'form.parameter.mail_devis_com', 'translation_domain' => 'FOSUserBundle'))
            ->add('mailDevisValid',CheckboxType::class , array('label' => 'form.parameter.mail_devis_valid', 'translation_domain' => 'FOSUserBundle'))
            ->add('isPublic',CheckboxType::class , array('label' => 'form.parameter.is_public', 'translation_domain' => 'FOSUserBundle'))
            ->add('newsletter',CheckboxType::class , array('label' => 'form.parameter.newsletter', 'translation_domain' => 'FOSUserBundle'))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CmaUserBundle\Entity\Parameter'
        ));
    }
}
