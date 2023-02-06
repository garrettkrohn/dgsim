<?php

namespace App\Repository;

use App\Entity\PlayerUpdateLogs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PlayerUpdateLogs>
 *
 * @method PlayerUpdateLogs|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlayerUpdateLogs|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlayerUpdateLogs[]    findAll()
 * @method PlayerUpdateLogs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayerUpdateLogsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlayerUpdateLogs::class);
    }

    public function save(PlayerUpdateLogs $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PlayerUpdateLogs $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return PlayerUpdateLogs[] Returns an array of PlayerUpdateLogs objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PlayerUpdateLogs
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
