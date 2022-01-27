<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\Produit;
use App\Form\SearchType;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProduitController extends AbstractController
{
    /**
     * @Route("/nos-produits", name="produits" ,methods={"GET"})
     */
    public function index(ProduitRepository $repo,Request $request,EntityManagerInterface $manager): Response
    {
        //instanciation de l'objet search
        $search = new Search();

    // instanciation du formulaire  et le lié a l objet
        $form = $this->createForm(SearchType::class,$search);
        //recuperation de la requête
        $form->handleRequest($request);
        //soumission du formulaire
        if($form->isSubmitted() && $form->isValid()){
//recherche des produits dans la barre de recherche
            $produits = $repo->findWithSearch($search);
        }else{
             //affichage des produits grace a l'injection de dependance dans la fonction .

        $produits = $repo->findAll();
       
        }
        return $this->render('produit/index.html.twig ',[
            'produits'=>$produits,
            'formSearch'=> $form->createView(),
        ] );
    }
    //methode qui affiche un article a appartir du slug.

/**
     * @Route("/produit/{slug}", name="show", methods={"GET"})
     */
    public function show(Produit $produit): Response
    {
        if(!$produit){
            return $this->redirectToRoute('produits');
        }
        return $this->render("produit/show.html.twig",[
            "slug"=>$produit->getslug(),
         'produit'=>$produit,
    
           
        ]);
    }

    
}
