<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Category>
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }
    
    /**
     * This function add/update category in DB
     * @param Category $category
     * @param bool $flush
     * @return Category
     */
    public function save(Category $category, bool $flush = false): Category {
        $em = $this->getEntityManager();
        $em->persist($category);
        
        if($flush == true) {
            $em->flush();
        }
        
        return $category;
    }
    
    /**
     * This function remove category from DB
     * @param Category $category
     * @return Category
     */
    public function remove(Category $category): Category {
        $em = $this->getEntityManager();
        $em->remove($category);
        $em->flush();
        
        return $category;
    }
    
    /**
     * This function search categories in DB by matching name pattern
     * @param string $q
     * @return array
     */
    public function searhCategory(string $q) : array {
        return $this->createQueryBuilder('category')
            ->andWhere('category.name like :q')
            ->setParameter('q', '%' . $q .'%')
            ->getQuery()
            ->getResult()
        ;
    }
    
    /**
     * This function search categories in DB by matching name pattern
     * @param string $q
     * @return array
     */
    public function searchCategoryCount(string $q) : array {
        return $this->createQueryBuilder('category')
        ->select('COUNT(category)')
        ->andWhere('category.name like :q')
        ->setParameter('q', '%' . $q .'%')
        ->getQuery()
        ->getOneOrNullResult()
        ;
    }

    //    /**
    //     * @return Category[] Returns an array of Category objects
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

    //    public function findOneBySomeField($value): ?Category
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
