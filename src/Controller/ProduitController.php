<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProduitController extends AbstractController
{
    /**
     * @Route("/nos-produits", name="produits")
     */
    public function index(ProduitRepository $repo): Response
    {
        $produits = $repo->findAll();
        return $this->render('produit/index.html.twig ',[
            'produits'=>$produits,
        ] );
    }
}
