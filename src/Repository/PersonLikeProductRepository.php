<?php

namespace App\Repository;

use App\Entity\PersonLikeProduct;
use App\Entity\Person;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PersonLikeProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method PersonLikeProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method PersonLikeProduct[]    findAll()
 * @method PersonLikeProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonLikeProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PersonLikeProduct::class);
    }

    public function getSearchClasses( $query_person=null, $query_product=null)
    {
        $qb = $this->createQueryBuilder('p')
            ->select('p')
            ->innerJoin('p.person', 'pe')
            ->innerJoin('p.product', 'pr');

        if($query_person && $query_person !== '') {
            $qb->where('pe.lName LIKE :query_person')
                ->orWhere('pe.fName LIKE :query_person')
                ->setParameter('query_person', '%' . $query_person . '%');
        }

        if($query_product && $query_product !== '') {
            $qb->andwhere('pr.name LIKE :query_product')
                ->setParameter('query_product', '%' . $query_product . '%');
        }

        return $qb->getQuery()->getResult();

    }

}
