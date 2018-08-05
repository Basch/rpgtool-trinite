<?php

namespace App\Repository;

use App\Entity\SideMenu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SideMenu|null find($id, $lockMode = null, $lockVersion = null)
 * @method SideMenu|null findOneBy(array $criteria, array $orderBy = null)
 * @method SideMenu[]    findAll()
 * @method SideMenu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SideMenuRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SideMenu::class);
    }

//    /**
//     * @return SideMenu[] Returns an array of SideMenu objects
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
    public function findOneBySomeField($value): ?SideMenu
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
