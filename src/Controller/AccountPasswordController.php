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

class AccountPasswordController extends AbstractController
{
    /**
     * @Route("/account/modifier-mot-de-passe", name="account_password")
     */
    public function password(Request $request,UserPasswordHasherInterface $encoder,EntityManagerInterface $manager): Response
    {
        $customer = $this->getUser();
        $form = $this->createForm(ChangePasswordType::class,$customer);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
         $manager->persist($customer);
         $manager->flush();

        }
        return $this->render('account/password.html.twig',[
            'formpass'=>$form->createview(),
        ]);
    
    }
}
