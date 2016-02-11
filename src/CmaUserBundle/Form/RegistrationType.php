<?php

namespace CmaUserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use CmaUserBundle\Form\ParameterRegistrationType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('parameter', ParameterRegistrationType::class, array('label' => 'form.parameter.newsletter','required' => false, 'translation_domain' => 'FOSUserBundle'));
        $builder->add('publicPolicy', CheckboxType::class, array('label' => 'form.publicpolicy','required' => true, 'translation_domain' => 'FOSUserBundle'));
        $builder->add('group', EntityType::class, array('class' => 'CmaUserBundle:Group','choice_label' => 'name',"multiple" => true ,'translation_domain' => 'FOSUserBundle','choice_translation_domain' => 'FOSUserBundle'));
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';

        // Or for Symfony < 2.8
        // return 'cma_user_registration';
    }

    public function getBlockPrefix()
    {
        return 'cma_user_registration';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
?>