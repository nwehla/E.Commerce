<?php

namespace App\Form;

use App\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname',TextType::class,[
                'label'=>'prenom','attr'=>['placeholder'=>'merci de saisir votre prenom']
            ])
            ->add('lastname',TextType::class,[
                'label'=>'nom','attr'=>['placeholder'=>'merci de saisir de saisir votre nom']
            ])
            ->add('email',EmailType::class,['label'=>'Mail','attr'=>['placeholder'=>'merci de saisir votre mail']
            ])
            ->add('password',RepeatedType::class,['type'=>PasswordType::class,'invalid_message'=>'le mot de passe et la confirmation doivent être identiques',
            'first_options'=>['label'=>'mot de passe'],
            'attr'=>['placeholder'=>"Merci d'entrer votre mot de passe"],
            'second_options'=>['label'=>'confirmation du mot de passe'],
            'attr'=>['placeholder'=>"Merci de confirmer votre mot de passe"]
            ])
            
            ->add('submit',SubmitType::class,["label"=>"S'inscrire"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Customer::class,
        ]);
    }
}
