<?php

namespace CmaUserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ComplainType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',null,array('required' => true,
                'label' => 'form.complain.username',
                'translation_domain' => 'FOSUserBundle'))
            ->add('name',null,array('required' => true,
                'label' => 'form.complain.name',
                'translation_domain' => 'FOSUserBundle'))
            ->add('firstname',null,array('required' => true,
                'label' => 'form.complain.firstname',
                'translation_domain' => 'FOSUserBundle'))
            ->add('phoneNumber',null,array('required' => false,
                'label' => 'form.complain.phoneNumber',
                'translation_domain' => 'FOSUserBundle'))
            ->add('mailAddress',null,array('required' => true,
                'label' => 'form.complain.mailAddress',
                'translation_domain' => 'FOSUserBundle'))
            ->add('complain',null,array(
                'translation_domain'=>'FOSUserBundle',
                'attr'=>array('class'=>'description',
                    'style'=>'width:100%;height:180px',
                    'placeholder'=>'form.complain.complain'
                    )))
            ->add('image',ImageType::class,array('required' => false,
                'label' => false,
                'translation_domain' => 'FOSUserBundle'))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CmaUserBundle\Entity\Complain'
        ));
    }
}
