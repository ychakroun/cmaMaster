<?php

namespace CmaUserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class InformationArtistType extends AbstractType
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
            ->add('zip',TextType::class, array(
              'label' => 'form.information.zipcode',
              'required' => false,
              'translation_domain' => 'FOSUserBundle'
            ))
            ->add('city',TextType::class, array(
              'label' => 'form.information.city',
              'required' => false,
              'translation_domain' => 'FOSUserBundle'
            ))
            ->add('pays',TextType::class, array(
              'label' => 'form.information.pays',
              'required' => false,
              'translation_domain' => 'FOSUserBundle'
            ))
            ->add('siret',TextType::class, array(
              'label' => 'form.information.siret',
              'required' => false,
              'translation_domain' => 'FOSUserBundle'
            ))
            ->add('aBank',TextType::class, array(
              'label' => 'form.information.aBank',
              'required' => false,
              'translation_domain' => 'FOSUserBundle'
            ))
            ->add('ownerBank',TextType::class, array(
              'label' => 'form.information.ownerBank',
              'required' => false,
              'translation_domain' => 'FOSUserBundle'
            ))
            ->add('resBank',TextType::class, array(
              'label' => 'form.information.resBank',
              'required' => false,
              'translation_domain' => 'FOSUserBundle'
            ))
            ->add('rib',TextType::class, array(
              'label' => 'form.information.rib',
              'required' => false,
              'translation_domain' => 'FOSUserBundle'
            ))
            ->add('bic',TextType::class, array(
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
