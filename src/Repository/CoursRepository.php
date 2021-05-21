<?php

namespace App\Repository;

use App\Entity\Cours;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cours|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cours|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cours[]    findAll()
 * @method Cours[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cours::class);
    }

    // /**
    //  * @return Cours[] Returns an array of Cours objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Cours
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findAllJoinUser(){
        return $this->createQueryBuilder('cours')
            ->leftJoin('cours.responsable', 'cr')
            ->andWhere('cours.date >= CURRENT_DATE()')
            ->orderBy('cours.id', 'DESC')
            ->getQuery()
            ->execute();
    }
    public function findOneByIdJoinUser($id){
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'Select c.id as id, c.responsable_id, c.nom, c.description, c.date, c.temps, c.nb_participants, u.email, u.roles, u.password, u.alias from cours c 
                join user u on u.id = c.responsable_id
                where c.id = :id';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array('id' => $id));
        return $stmt->fetch();
    }
}
