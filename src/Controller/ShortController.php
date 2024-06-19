<?php

namespace App\Controller;

use App\Entity\Orders;
use App\Entity\Videos;
use App\Form\VideosType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShortController extends AbstractController
{
    #[Route("/", name:"videos_list")]
    public function listVideos(EntityManagerInterface $em): JsonResponse
    {
        $videos = $em->getRepository(Videos::class)->findAll();
        return $this->json($videos);
    }
}


