<?php

namespace CmaUserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class InformationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('adress',TextType::class, array(
              'label' => 'form.information.adress',
              'required' => false,
              'translation_domain' => 'FOSUserBundle',
              'attr' => array('class' => 'test')
            ))
            ->add('zip',null, array(
              'label' => 'form.information.zipcode',
              'required' => false,
              'translation_domain' => 'FOSUserBundle'
            ))
            ->add('city',null, array(
              'label' => 'form.information.city',
              'required' => false,
              'translation_domain' => 'FOSUserBundle'
            ))
            ->add('pays',null, array(
              'label' => 'form.information.pays',
              'required' => false,
              'translation_domain' => 'FOSUserBundle'
            ))
            ->add('siret',null, array(
              'label' => 'form.information.siret',
              'required' => false,
              'translation_domain' => 'FOSUserBundle'
            ))
            ->add('aBank',null, array(
              'label' => 'form.information.aBank',
              'required' => false,
              'translation_domain' => 'FOSUserBundle'
            ))
            ->add('ownerBank',null, array(
              'label' => 'form.information.ownerBank',
              'required' => false,
              'translation_domain' => 'FOSUserBundle'
            ))
            ->add('resBank',null, array(
              'label' => 'form.information.resBank',
              'required' => false,
              'translation_domain' => 'FOSUserBundle'
            ))
            ->add('rib',null, array(
              'label' => 'form.information.rib',
              'required' => false,
              'translation_domain' => 'FOSUserBundle'
            ))
            ->add('bic',null, array(
              'label' => 'form.information.bic',
              'required' => false,
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
            'data_class' => 'CmaUserBundle\Entity\Information'
        ));
    }
}
