<?php

namespace App\Repository;

use App\Entity\CarItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CarItem>
 *
 * @method CarItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarItem[]    findAll()
 * @method CarItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarItem::class);
    }

    public function getAllCars($pageNumber, $numeberOfItemsInPage) {
        return $this->createQueryBuilder('c')
            ->setMaxResults($numeberOfItemsInPage)
            ->setFirstResult(($pageNumber-1)*10)
            ->getQuery()
            ->getResult()
            ;
    }

    public function getNumberOfCars(){
        return sizeof($this->createQueryBuilder('c')
        ->getQuery()
        ->getResult()
    );
    }

//    /**
//     * @return CarItem[] Returns an array of CarItem objects
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

//    public function findOneBySomeField($value): ?CarItem
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
