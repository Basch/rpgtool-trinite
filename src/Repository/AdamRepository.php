<?php

namespace App\Repository;

use App\Entity\Adam;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Adam|null find($id, $lockMode = null, $lockVersion = null)
 * @method Adam|null findOneBy(array $criteria, array $orderBy = null)
 * @method Adam[]    findAll()
 * @method Adam[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdamRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Adam::class);
    }

//    /**
//     * @return Adam[] Returns an array of Adam objects
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
    public function findOneBySomeField($value): ?Adam
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
