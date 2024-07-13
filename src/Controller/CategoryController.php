<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\TicketRepository;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function index(
        Request $request,
        CategoryRepository $categoryRepository,
        TicketRepository $ticketRepository
    ): Response
    {
        $q = $request->query->get('q', '');
        
        //Fetch no of records by matching criteria
        $categories = $categoryRepository->searhCategory($q);
        $count = $categoryRepository->searchCategoryCount($q);
        
        $tickets = $ticketRepository->getTickets($q);
        
        return $this->render('category/index.html.twig', [
            'categories' => $categories,
            'count' => $count,
            'tickets' => $tickets
        ]);
    }
    
    #[Route('/category/add', name: 'app_category_add')]
    public function add(
        CategoryRepository $categoryRepository
    ): Response
    {
        $category = new Category();
        $category->setName('Category-' . rand(10, 99));
        
        $categoryRepository->save($category, true);
        
        $this->addFlash('success', 'Category Added Successfully: ' . $category->getName());
        
        return $this->redirectToRoute('app_category');
    }
    
    #[Route('/category/{id}', name: 'app_category_edit')]
    public function edit(
        int $id,
        CategoryRepository $categoryRepository
    ): Response
    {
        $category = $categoryRepository->find($id);
        if(!$category instanceof Category) {
            $this->addFlash('erros', 'Invalid categopry provided');
        }
        
        $category->setName('Category-Changed-' . rand(10, 99));
        
        $categoryRepository->save($category, true);
        
        $this->addFlash('success', 'Category Updated Successfully: ' . $category->getName());
        
        return $this->redirectToRoute('app_category');
    }
    
    #[Route('/category/{id}/remove', name: 'app_category_remove')]
    public function remove(
        int $id,
        CategoryRepository $categoryRepository
        ): Response
        {
            $category = $categoryRepository->find($id);
            if(!$category instanceof Category) {
                $this->addFlash('erros', 'Invalid categopry provided');
            }
            
            $category = $categoryRepository->remove($category);
            
            $this->addFlash('success', 'Category Updated Successfully: ' . $category->getName());
            
            return $this->redirectToRoute('app_category');
    }
}
