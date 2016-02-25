<?php

namespace CmaUserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PieceType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',null,array('label' => 'form.piece.title','required' => true,'translation_domain' => 'FOSUserBundle'))
            ->add('collection',null,array('label' => 'form.piece.collection','required' => false,'translation_domain' => 'FOSUserBundle'))
            ->add('realisationDate',DateType::class, array(
                'input'  => 'datetime',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'required' => false,
                'label' => false
            ))
            ->add('price',MoneyType::class,array('label' => 'form.piece.price','required' => true,'translation_domain' => 'FOSUserBundle'))
            ->add('theme',null,array('label' => 'form.piece.theme','required' => false,'translation_domain' => 'FOSUserBundle'))
            ->add('feature',null,array('label' => 'form.piece.feature','required' => false,'translation_domain' => 'FOSUserBundle'))
            ->add('technics',null,array('label' => 'form.piece.technics','required' => false,'translation_domain' => 'FOSUserBundle'))
            ->add('image1',ImageType::class,array('required' => false,'label' => false, 'translation_domain' => 'FOSUserBundle'))
            ->add('image2',ImageType::class,array('required' => false,'label' => false, 'translation_domain' => 'FOSUserBundle'))
            ->add('image3',ImageType::class,array('required' => false,'label' => false, 'translation_domain' => 'FOSUserBundle'))
            ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CmaUserBundle\Entity\Piece'
        ));
    }
}
