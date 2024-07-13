<?php

namespace App\Repository;

use App\Entity\Ticket;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ticket>
 */
class TicketRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ticket::class);
    }
    
    /**
     * This function add/update ticket in DB
     * @param Ticket $ticket
     * @param bool $flush
     * @return Ticket
     */
    public function save(Ticket $ticket, bool $flush = false): Ticket {
        $em = $this->getEntityManager();
        $em->persist($ticket);
        
        if($flush == true) {
            $em->flush();
        }
        
        return $ticket;
    }
    
    /**
     * This function remove ticket from DB
     * @param Ticket $ticket
     * @return Ticket
     */
    public function remove(Ticket $ticket): Ticket {
        $em = $this->getEntityManager();
        $em->remove($ticket);
        $em->flush();
        
        return $ticket;
    }
    
    public function getTickets(string $q) : array {
        return $this->createQueryBuilder('ticket')
            ->leftJoin('ticket.category', 'category')
            ->andWhere('category.name like :q')
            ->setParameter('q', '%' . $q .'%')
            ->getQuery()
            ->getResult()
        ;
    }

    //    /**
    //     * @return Ticket[] Returns an array of Ticket objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('t.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Ticket
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
