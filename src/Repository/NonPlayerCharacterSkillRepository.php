<?php

namespace App\Repository;

use App\Entity\NonPlayerCharacterSkill;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method NonPlayerCharacterSkill|null find($id, $lockMode = null, $lockVersion = null)
 * @method NonPlayerCharacterSkill|null findOneBy(array $criteria, array $orderBy = null)
 * @method NonPlayerCharacterSkill[]    findAll()
 * @method NonPlayerCharacterSkill[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NonPlayerCharacterSkillRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, NonPlayerCharacterSkill::class);
    }

//    /**
//     * @return NonPlayerCharacterSkill[] Returns an array of NonPlayerCharacterSkill objects
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
    public function findOneBySomeField($value): ?NonPlayerCharacterSkill
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
