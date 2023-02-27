<?php

namespace App\Repository;

use App\Entity\PlayerUpdateLog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PlayerUpdateLog>
 *
 * @method PlayerUpdateLog|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlayerUpdateLog|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlayerUpdateLog[]    findAll()
 * @method PlayerUpdateLog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayerUpdateLogsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlayerUpdateLog::class);
    }

    public function save(PlayerUpdateLog $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PlayerUpdateLog $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return PlayerUpdateLog[] Returns an array of PlayerUpdateLog objects
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

//    public function findOneBySomeField($value): ?PlayerUpdateLog
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
