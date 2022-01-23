<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Encoder\PasswordHasherEncoder;

class AccountPasswordController extends AbstractController
{
    /**
     * @Route("/account/modifier-mot-de-passe", name="account_password")
     */
    public function password(Request $request,UserPasswordHasherInterface $encoder,EntityManagerInterface $manager): Response
    { 
        //recupération de l'utilisateur en cours
        $customer = $this->getUser();
        dd($customer);
        
        //creation du formulaire  de modification du mot de passe 
        //avec appel du changepasswordType ,lié à l'utilisateur en cours
        $form = $this->createForm(ChangePasswordType::class,$customer);
        
        //recupération  de la requète
        $form->handleRequest($request);
        
        // soumission du formulaire
        if($form->isSubmitted() && $form->isValid()){
            //recupération du old_password du formulaire
            $old_pwd = $form->get('old_password')->getData();
            //comparaison du mot de passe actuel avec le mot de passe en base de données
            if($encoder->isPasswordValid($customer,$old_pwd)){
                //recupération du nouveau mot de passe
                $new_pwd = $form->get('new_password')->getData();
                //encodage du nouveau mot de passe
                $enco_new_pwd = $encoder->hashPassword($customer,$new_pwd);
                //enregistrement du mot de passe encodé dans le formulaire
                // on persist 
                $manager->persist($customer);
                // on flush

                $manager->flush();
                return $this->render('account/password.html.twig',[
                    'formpass'=>$form->createview(),
                  ]);
                }
         
        }
        
       
    
    }
}
