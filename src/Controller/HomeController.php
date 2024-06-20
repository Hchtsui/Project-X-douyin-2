<?php

// src/Controller/HomeController.php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Videos;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home_page')]
    public function home(EntityManagerInterface $em): Response
    {
        $categories = $em->getRepository(Categories::class)->findAll();
        $videos = $em->getRepository(Videos::class)->findAll();

        return $this->render('home/index.html.twig', [
            'categories' => $categories,
            'videos' => $videos,
        ]);
    }

    #[Route('/category', name: 'app_category')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $categories = $entityManager->getRepository(Categories::class)->findAll();
        $videos = $entityManager->getRepository(Videos::class)->findAll();

        return $this->render('category/index.html.twig', [
            'categories' => $categories,
            'videos' => $videos,
        ]);
    }

    #[Route('/category/{id}', name: 'category_page')]
    public function showCategory(EntityManagerInterface $entityManager, int $id, Request $request): Response
    {
        $category = $entityManager->getRepository(Categories::class)->find($id);

        if (!$category) {
            throw $this->createNotFoundException('No category found for id ' . $id);
        }

        $tagParam = $request->query->get('tags', '#All');
        $tagNames = is_string($tagParam) ? explode(',', $tagParam) : (array) $tagParam;

        if (empty($tagNames)) {
            $tagNames = ['#All'];
        }

        $videos = $entityManager->getRepository(Videos::class)->findByCategoryAndTags($id, $tagNames);

        return $this->render('category/show.html.twig', [
            'category' => $category,
            'videos' => $videos,
            'tagNames' => $tagNames,
        ]);
    }

    #[Route("/videos/filter", name:"videos_filter_by_category_and_tags")]
    public function filterVideosByCategoryAndTags(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $categoryId = $request->query->get('category');
        $tagParam = $request->query->get('tags', '#All');
        $tagNames = is_string($tagParam) ? explode(',', $tagParam) : (array) $tagParam;

        // Ensure the tagNames array contains values, if empty default to #All
        if (empty($tagNames)) {
            $tagNames = ['#All'];
        }

        $videos = $em->getRepository(Videos::class)->findByCategoryAndTags($categoryId, $tagNames);
        return $this->json($videos);
    }
}
