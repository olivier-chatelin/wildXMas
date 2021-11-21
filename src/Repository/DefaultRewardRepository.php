<?php

namespace App\Repository;

use App\Entity\DefaultReward;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DefaultReward|null find($id, $lockMode = null, $lockVersion = null)
 * @method DefaultReward|null findOneBy(array $criteria, array $orderBy = null)
 * @method DefaultReward[]    findAll()
 * @method DefaultReward[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DefaultRewardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DefaultReward::class);
    }

    // /**
    //  * @return DefaultReward[] Returns an array of DefaultReward objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DefaultReward
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
