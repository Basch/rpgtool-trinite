<?php

namespace App\Repository;

use App\Entity\NonPlayerCharacter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method NonPlayerCharacter|null find($id, $lockMode = null, $lockVersion = null)
 * @method NonPlayerCharacter|null findOneBy(array $criteria, array $orderBy = null)
 * @method NonPlayerCharacter[]    findAll()
 * @method NonPlayerCharacter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NonPlayerCharacterRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, NonPlayerCharacter::class);
    }

//    /**
//     * @return NonPlayerCharacter[] Returns an array of NonPlayerCharacter objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NonPlayerCharacter
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
