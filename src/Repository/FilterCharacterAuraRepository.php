<?php

namespace App\Repository;

use App\Entity\FilterCharacterAura;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FilterCharacterAura|null find($id, $lockMode = null, $lockVersion = null)
 * @method FilterCharacterAura|null findOneBy(array $criteria, array $orderBy = null)
 * @method FilterCharacterAura[]    findAll()
 * @method FilterCharacterAura[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FilterCharacterAuraRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FilterCharacterAura::class);
    }

//    /**
//     * @return FilterCharacterAsset[] Returns an array of FilterCharacterAsset objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FilterCharacterAsset
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
