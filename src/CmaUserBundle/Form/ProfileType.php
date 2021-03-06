<?php

namespace CmaUserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use CmaUserBundle\Form\ImageType;
use CmaUserBundle\Entity\Tag;

class ProfileType extends AbstractType
{
    protected $pre_submit;
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description',null,array(
              'label' => 'form.profile.description',
              'required' => false,'label' => false,
              'translation_domain' => 'FOSUserBundle'))
            ->add('imageHeader',ImageType::class,array(
              'required' => false,
              'label' => false,
              'translation_domain' =>
              'FOSUserBundle'))
            ->add('image1',ImageType::class,array(
              'required' => false,
              'label' => false,
              'translation_domain' => 'FOSUserBundle'))
            ->add('image2',ImageType::class,array(
              'required' => false,
              'label' => false,
              'translation_domain' =>
              'FOSUserBundle'))
            ->add('image3',ImageType::class,array(
              'required' => false,
              'label' => false,
              'translation_domain' =>
              'FOSUserBundle'))
            ->add('tags', CollectionType::class, array(
              'entry_type' => TagType::class,
              'allow_delete' => true,
              'allow_add'=> true,
              'by_reference' => false,
              'required' => false))
            ->add('condition', CheckboxType::class,array("mapped" => false,
                'required' => true,
                'label' => "J'accepte les conditions d'utilisations",
                 'translation_domain' => 'FOSUserBundle'))
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
