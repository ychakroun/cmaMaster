<?php

namespace CmaUserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ParameterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        dump($options);
        $builder//->add('ad', EntityType::class, array(
        //         'class' => '\Your\Bundle\Entity\Ad',
        //         'query_builder' => function(\Your\Bundle\Repository\AdRepository $er) use ($company) {
        //         return $er->getActiveAdsQueryBuilder($company);
        //     }))
            ->add('mailDevisAll',CheckboxType::class , array('label' => 'form.parameter.mail_devis_all','required' => false, 'translation_domain' => 'FOSUserBundle'))
            ->add('mailDevisUser',CheckboxType::class , array('label' => 'form.parameter.mail_devis_user','required' => false, 'translation_domain' => 'FOSUserBundle'))
            ->add('mailDevisCom',CheckboxType::class , array('label' => 'form.parameter.mail_devis_com','required' => false, 'translation_domain' => 'FOSUserBundle'))
            ->add('mailDevisValid',CheckboxType::class , array('label' => 'form.parameter.mail_devis_valid','required' => false, 'translation_domain' => 'FOSUserBundle'))
            ->add('isPublic',CheckboxType::class , array('label' => 'form.parameter.is_public','required' => false, 'translation_domain' => 'FOSUserBundle'))
            ->add('newsletter',CheckboxType::class , array('label' => 'form.parameter.newsletter','required' => false, 'translation_domain' => 'FOSUserBundle'))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CmaUserBundle\Entity\Parameter',
            'data' => 'Default value'
        ));
    }
    // function __construct() {
    //     $this->parameter = $this->get('home_page.userServices')->allParameter();
    // }
}
