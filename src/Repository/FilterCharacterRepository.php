<?php

namespace App\Repository;

use App\Entity\FilterCharacter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FilterCharacter|null find($id, $lockMode = null, $lockVersion = null)
 * @method FilterCharacter|null findOneBy(array $criteria, array $orderBy = null)
 * @method FilterCharacter[]    findAll()
 * @method FilterCharacter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FilterCharacterRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FilterCharacter::class);
    }

//    /**
//     * @return FilterCharacter[] Returns an array of FilterCharacter objects
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
    public function findOneBySomeField($value): ?FilterCharacter
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
