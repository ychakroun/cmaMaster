<?php

namespace CmaUserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PieceProposalType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('price',null,array(
                'label' => 'form.proposal.price',
                'required' => true,
                'translation_domain' => 'FOSUserBundle',
                'attr' => array('placeholder' => '€')
                ))
            ->add('feature',TextType::class,array('label' => 'form.piece.feature',
                'required' => false,
                'translation_domain' => 'FOSUserBundle'
                ))
            ->add('technics',TextType::class,array('label' => 'form.piece.technics'
                ,'required' => false,
                'translation_domain' => 'FOSUserBundle'))
            ->add('width',null,array('label' => 'form.piece.width',
                'required' => false,
                'translation_domain' => 'FOSUserBundle',
                'attr' => array('class' => 'largeur','placeholder' => 'en cm')
                ))
            ->add('height',null,array('label' => 'form.piece.height',
                'required' => false,
                'translation_domain' => 'FOSUserBundle',
                'attr' => array('class' => 'hauteur','placeholder' => 'en cm')
                ))
            ->add('image1',ImageType::class,array('required' => false,
                'label' => false,
                'translation_domain' => 'FOSUserBundle'))
            ->add('image2',ImageType::class,array('required' => false,
                'label' => false,
                'translation_domain' => 'FOSUserBundle'))
            ->add('image3',ImageType::class,array('required' => false,
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
            'data_class' => 'CmaUserBundle\Entity\Piece'
        ));
    }
}
