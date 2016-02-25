<?php

namespace CmaUserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use CmaUserBundle\Entity\Comment;

class CommentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('comment',TextareaType::class,array(
                'required'=>false,
                'data' => '',
                'translation_domain'=>'FOSUserBundle',
                'attr'=>array('class'=>'commentContent',
                    'placeholder' => 'form.comment.placeholder')
                ))
            ->add('image',ImageType::class,array('label' => false,'required'=>false))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CmaUserBundle\Entity\Comment'
        ));
    }
}
