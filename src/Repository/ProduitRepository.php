<?php

namespace App\Repository;

use App\Classe\Search;
use App\Entity\Produit;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Produit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produit[]    findAll()
 * @method Produit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produit::class);
    }

    // /**
    //  * @return Produit[] Returns an array of Produit objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Produit
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    /**
     *Requette qui me permet de recupérer la recherche de l'utilisateur 
     * @ Return Produit[]
     */
    public function findWithSearch(Search $search)
    {
        $query= $this->createQueryBuilder('p')
            ->select('p','c')
            ->join('p.categorie', 'c');

            if(!empty($search->categorie)){
                $query = $query
                         ->andWhere('c.id IN (:categorie)')
                         ->setParameter('categorie' , $search->categorie);
            }

            if(!empty($search->string)){
                $query = $query
                         ->andWhere('p.name LIKE :string')
                         ->setParameter('string' , "%{$search->string}%");
            }
            return $query->getQuery()->getResult()
        ;
    }
    

}
