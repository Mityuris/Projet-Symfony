<?php

namespace App\Repository;

use App\Entity\CarPost;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CarPost>
 *
 * @method CarPost|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarPost|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarPost[]    findAll()
 * @method CarPost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarPostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarPost::class);
    }

//    /**
//     * @return CarPost[] Returns an array of CarPost objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CarPost
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
