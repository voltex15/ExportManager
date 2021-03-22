<?php

namespace App\Repository;

use App\Entity\Export;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Export|null find($id, $lockMode = null, $lockVersion = null)
 * @method Export|null findOneBy(array $criteria, array $orderBy = null)
 * @method Export[]    findAll()
 * @method Export[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Export::class);
    }

    // /**
    //  * @return Export[] Returns an array of Export objects
    //  */
    public function findByLocalAndDateFromAndDateTo($localId = null, $dateFrom = null, $dateTo = null)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT user
            FROM export
            LEFT JOIN local ON (export.local_id = local.id)
            LEFT JOIN user ON (export.user_id = user.id) 
            WHERE 1 ';

        if ( $localId )
        {
            $sql .= 'AND local.id = ' . $localId;
        }
        if ( $dateFrom )
        {
            $sql .= 'AND export.exportDate >= "' . $dateFrom . ' 00:00:00"';
        }
        if ( $dateTo )
        {
            $sql .= 'AND export.exportDate <= "' . $dateTo . ' 23:59:59"';
        }

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAllAssociative();
    }

    /*
    public function findOneBySomeField($value): ?Export
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
