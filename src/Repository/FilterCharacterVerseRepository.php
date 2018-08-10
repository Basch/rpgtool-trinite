<?php

namespace App\Repository;

use App\Entity\FilterCharacterVerse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FilterCharacterVerse|null find($id, $lockMode = null, $lockVersion = null)
 * @method FilterCharacterVerse|null findOneBy(array $criteria, array $orderBy = null)
 * @method FilterCharacterVerse[]    findAll()
 * @method FilterCharacterVerse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FilterCharacterVerseRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FilterCharacterVerse::class);
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
