<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function index(EntityManagerInterface $manager,Request $request,UserPasswordHasherInterface $encoder): Response
    {    
        $customer = new Customer();   
        $form = $this->createForm(InscriptionType::class,$customer);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $pass = $encoder->hashPassword($customer, $customer->getPassword());
            $customer ->setPassword($pass);
            $manager->persist($customer);
            $manager->flush();
        }
        return $this->render('register/inscription.html.twig',[
            'formInscription'=>$form->createView()
        ]);
    }
}
