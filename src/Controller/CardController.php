<?php

namespace App\Controller;

use App\Classe\Card;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CardController extends AbstractController
{
    /**
     * @Route("/mon_panier", name="card")
     */
    public function index(Card $card ,ProduitRepository $repo): Response
    {
       //dd($card->get());
       $cardComplete = [];
       foreach($card->get()as$id=>$quantite){
           $cardComplete [] = [
               'produit'=> $repo->findOneById($id),
               'quantité'=>$quantite,
           ];
       }
        return $this->render("card/index.html.twig",[
            //'card'=>$card->get(),
            'card'=>$cardComplete,
        ]);
    }
    
    /**
     * @Route("/card/ajouter/{id}", name="add_to_card")
     */
    public function ajouter(Card $card,$id): Response
    {
        $card->ajouter($id);
        
        return $this->redirectToRoute('card');
    }
    
    /**
     * @Route("/card/remove", name="remove_my_card")
     */
    public function remove(Card $card): Response
    {
        $card->remove();
        return $this->redirectToRoute('produits');
    }
}
