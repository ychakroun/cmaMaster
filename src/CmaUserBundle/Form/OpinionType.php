<?php

namespace CmaUserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
class OpinionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('opinion',TextareaType::class, array(
              'label' => 'form.opinion.opinion',
              'required' => true,
              'translation_domain' => 'FOSUserBundle',
              'attr' => array('class' => 'opinion')
            ))
            ->add('title',null, array(
              'label' => 'form.opinion.title',
              'required' => true,
              'translation_domain' => 'FOSUserBundle',
              'attr' => array('class' => 'opinionTitle')
            ))
            ->add('image',ImageType::class,array('required' => false,
                'label' => false,
                 'translation_domain' => 'FOSUserBundle',
                 'attr' => array('class' => 'imageOpinion')
            ))
            ->add('submit', SubmitType::class, array(
                'attr' => array("mapped" => false,
                    'class' => 'buttonAction',
                    ),
                'label'=>'form.opinion.submit',
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
            'data_class' => 'CmaUserBundle\Entity\Opinion'
        ));
    }
}
