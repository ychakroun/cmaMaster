<?php

namespace CmaUserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use CmaUserBundle\Form\ImageType;

class ProfileType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description',null,array('label' => 'form.profile.description','required' => false, 'translation_domain' => 'FOSUserBundle'))
            ->add('imageHeader',ImageType::class,array('label' => 'form.profile.description','required' => false, 'translation_domain' => 'FOSUserBundle'))
            ->add('image1',ImageType::class,array('label' => 'form.profile.image','required' => false, 'translation_domain' => 'FOSUserBundle'))
            ->add('image2',ImageType::class,array('label' => 'form.profile.image','required' => false, 'translation_domain' => 'FOSUserBundle'))
            ->add('image3',ImageType::class,array('label' => 'form.profile.image','required' => false, 'translation_domain' => 'FOSUserBundle'))
            ->add('tags', CollectionType::class, array('allow_delete' => true,'allow_add'=> true,'by_reference' => false,'required' => false,'entry_type' => TagType::class))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CmaUserBundle\Entity\Profile'
        ));
    }
}
