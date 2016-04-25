<?php
namespace CmaUserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use CmaUserBundle\Form\InformationArtistType;
use FOS\UserBundle\Form\Type\ProfileFormType;
use FOS\UserBundle\Util\LegacyFormHelper;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class ArtistInformationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('username', null, array(
          'disabled'=>true,
          'label' => 'form.username',
          'translation_domain' => 'FOSUserBundle'
        ))
        ->add('name', null, array(
          'required'=>true,
          'label' => 'form.firstname',
          'translation_domain' => 'FOSUserBundle'
        ))
        ->add('firstname', null, array(
          'required'=>true,
          'label' => 'form.name',
          'translation_domain' => 'FOSUserBundle'
        ))
        ->add('email', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\EmailType'), array(
          'label' => 'form.email',
          'translation_domain' => 'FOSUserBundle'
        ))
        ->add('information', InformationArtistType::class, array(
          'label' => null,'required' => false,
          'translation_domain' => 'FOSUserBundle'
        ))
        ->add('birthday', BirthdayType::class, array(
            'placeholder' => array('year'=>'année','month'=>'mois','day'=>'jour'),
            'format'=>'dd-MM-yyyy',
            'widget'=>'choice'
        ))       
        ;
    }
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CmaUserBundle\Entity\User',
        ));
    }
}
?>
