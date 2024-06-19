<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Videos;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
    public function showCategory(EntityManagerInterface $entityManager, int $id): Response
    {
        $category = $entityManager->getRepository(Categories::class)->find($id);

        if (!$category) {
            throw $this->createNotFoundException(
                'No category found for id ' . $id
            );
        }

        $videos = $category->getCategorieShorts();

        return $this->render('category/show.html.twig', [
            'category' => $category,
            'videos' => $videos,
        ]);
    }

    #[Route("/", name:"videos_list")]
    public function listVideos(EntityManagerInterface $em): JsonResponse
    {
        $videos = $em->getRepository(Videos::class)->findAll();
        return $this->json($videos);
    }
}
