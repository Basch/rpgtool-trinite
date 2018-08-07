<?php

namespace App\Repository;

use App\Entity\FireBlade;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FireBlade|null find($id, $lockMode = null, $lockVersion = null)
 * @method FireBlade|null findOneBy(array $criteria, array $orderBy = null)
 * @method FireBlade[]    findAll()
 * @method FireBlade[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FireBladeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FireBlade::class);
    }

//    /**
//     * @return FireBlade[] Returns an array of FireBlade objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FireBlade
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
