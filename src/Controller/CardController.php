<?php

namespace App\Controller;

use App\Classe\Card;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CardController extends AbstractController
{
    /**
     * @Route("/mon_panier", name="card")
     */
    public function index(): Response
    {
        return $this->render('card/index.html.twig', [
            'controller_name' => 'CardController',
        ]);
    }
    
    /**
     * @Route("/card/{id}", name="add_to_card")
     */
    public function ajouter(Card $card,$id): Response
    {
        $card->ajouter($id);
        return $this->redirectToRoute('card');
    }
    
    /**
     * @Route("/card/remove", name="remove_my_card")
     */
    public function remove(Card $card,$id): Response
    {
        $card->remove();
        return $this->redirectToRoute('produits');
    }
}
