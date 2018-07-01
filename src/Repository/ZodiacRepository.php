<?php

namespace App\Repository;

use App\Entity\Zodiac;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Zodiac|null find($id, $lockMode = null, $lockVersion = null)
 * @method Zodiac|null findOneBy(array $criteria, array $orderBy = null)
 * @method Zodiac[]    findAll()
 * @method Zodiac[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ZodiacRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Zodiac::class);
    }

//    /**
//     * @return Zodiac[] Returns an array of Zodiac objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('z.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Zodiac
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
