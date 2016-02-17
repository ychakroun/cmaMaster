<?php

namespace CmaUserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
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
            ->add('description',null,array('label' => 'form.profile.description','required' => false,'label' => false,'translation_domain' => 'FOSUserBundle'))
            ->add('imageHeader',ImageType::class,array('required' => false,'label' => false, 'translation_domain' => 'FOSUserBundle'))
            ->add('image1',ImageType::class,array('required' => false,'label' => false, 'translation_domain' => 'FOSUserBundle'))
            ->add('image2',ImageType::class,array('required' => false,'label' => false, 'translation_domain' => 'FOSUserBundle'))
            ->add('image3',ImageType::class,array('required' => false,'label' => false, 'translation_domain' => 'FOSUserBundle'))
            ->add('tags', CollectionType::class, array('allow_delete' => true,'allow_add'=> true,'by_reference' => false,'required' => false,'entry_type' => TagType::class))
            ->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
                $user = $event->getData();
                $form = $event->getForm();

                if (!$user) {
                    return;
                }
                
                if($user['imageHeader']['file']===null){
                    unset($user['imageHeader']);
                }
                if($user['image1']['file']===null){
                    unset($user['image1']);
                }
                if($user['image2']['file']===null){
                    unset($user['image2']);
                }
                if($user['image3']['file']===null){
                    unset($user['image3']);
                }
                $event->setData($user);
            })
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
