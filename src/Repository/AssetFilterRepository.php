<?php

namespace App\Repository;

use App\Entity\AssetFilter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AssetFilter|null find($id, $lockMode = null, $lockVersion = null)
 * @method AssetFilter|null findOneBy(array $criteria, array $orderBy = null)
 * @method AssetFilter[]    findAll()
 * @method AssetFilter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssetFilterRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AssetFilter::class);
    }

//    /**
//     * @return AssetFilter[] Returns an array of AssetFilter objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AssetFilter
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
