<?php

namespace App\Repository;

use App\Entity\Verse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Verse|null find($id, $lockMode = null, $lockVersion = null)
 * @method Verse|null findOneBy(array $criteria, array $orderBy = null)
 * @method Verse[]    findAll()
 * @method Verse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VerseRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Verse::class);
    }

//    /**
//     * @return Verse[] Returns an array of Verse objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Verse
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
