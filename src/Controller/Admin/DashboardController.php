<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use App\Entity\Customer;
use App\Entity\Categorie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Laboutiquefrancaise');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Customer', 'fas fa-Customer', Customer::class); 
        yield MenuItem::linkToCrud('Categorie', 'fas fa-Categorie', Categorie::class); 
        yield MenuItem::linkToCrud('Produit', 'fas fa-Produit', Produit::class); 
    }
}
