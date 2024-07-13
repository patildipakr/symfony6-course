<?php

namespace App\Repository;

use App\Entity\Comment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Comment>
 */
class CommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }
    
    /**
     * This function add/update comment in DB
     * @param Comment $comment
     * @param bool $flush
     * @return Comment
     */
    public function save(Comment $comment, bool $flush = false): Comment {
        $em = $this->getEntityManager();
        $em->persist($comment);
        
        if($flush == true) {
            $em->flush();
        }
        
        return $comment;
    }
    
    /**
     * This function remove comment from DB
     * @param Comment $comment
     * @return Comment
     */
    public function remove(Comment $comment): Comment {
        $em = $this->getEntityManager();
        $em->remove($comment);
        $em->flush();
        
        return $comment;
    }

    //    /**
    //     * @return Comment[] Returns an array of Comment objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Comment
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
