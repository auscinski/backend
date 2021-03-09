<?php

namespace App\Repository;

use App\Entity\PersonLikeProduct;
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

    // /**
    //  * @return CategoryProduct[] Returns an array of CategoryProduct objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */


//    public function findOneBy([$person_id,$product_id]): ?PersonLikeProduct
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.person = :person_id')
//            ->andWhere('p.product = :product_id')
//            ->setParameter('person_id', $person_id)
//            ->setParameter('product_id', $product_id)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

}
