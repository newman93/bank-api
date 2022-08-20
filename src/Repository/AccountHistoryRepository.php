<?php

namespace App\Repository;

use App\Entity\AccountHistory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AccountHistory>
 *
 * @method AccountHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method AccountHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method AccountHistory[]    findAll()
 * @method AccountHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccountHistoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AccountHistory::class);
    }

    public function add(AccountHistory $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AccountHistory $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    
    /**
     * @return AccountHistory[] Returns an array of AccountHistory objects
     */
    public function findAccountHistoryByNumberAndPin($number, $pin): array
    {
       return $this->createQueryBuilder('a')
            ->leftJoin('a.account', 'account')
            ->andWhere('account.number = :number')
            ->andWhere('account.pin = :pin')
            ->setParameters(['number' => $number, 'pin' => $pin])
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
//    /**
//     * @return AccountHistory[] Returns an array of AccountHistory objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AccountHistory
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
