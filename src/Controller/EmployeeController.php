<?php

namespace App\Controller;

use App\Entity\Orders;
use App\Entity\Videos;
use App\Form\VideosType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EmployeeController extends AbstractController
{
    #[Route('/employee', name: 'app_employee')]
    public function index(): Response
    {
        return $this->render('employee/index.html.twig', [
            'controller_name' => 'EmployeeController',
        ]);
    }
    #[Route("/addvideo", name: "add_video")]
    public function addVideo(Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(VideosType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $video = $form->getData();
            $em->persist($video);
            $em->flush();
            $this ->addFlash('success', 'Video added successfully');

            return $this->redirectToRoute('home_page');
        }
        return $this->render('employee/addvideo.html.twig', [
            'form' => $form
        ]);
    }

    #[\Symfony\Component\Routing\Attribute\Route('/showVideo', name: 'show_video')]
    public function showVideo(EntityManagerInterface $em): Response
    {
        $orders = $em->getRepository(Videos::class)->findAll();
        return $this->render('admin/index.html.twig', [
            'orders' => $orders
        ]);
    }
#[Route("/editVideo/{id}", name: "edit_video")]

    public function editVideo(int $id, Request $request, EntityManagerInterface $em): Response
    {
        // Fetch the existing video entity
        $video = $em->getRepository(Videos::class)->find($id);

        if (!$video) {
            throw $this->createNotFoundException('Video not found');
        }

        // Create the form with the existing video data
        $form = $this->createForm(VideosType::class, $video);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Persist and flush the changes to the database
            $em->flush();
            $this->addFlash('success', 'Video updated successfully');

            return $this->redirectToRoute('home_page');
        }

        // Render the form
        return $this->render('employee/editVideo.html.twig', [
            'form' => $form->createView()
        ]);
    }
    #[Route('/videos/delete/{id}', name: 'delete_videos')]
    public function deleteProduct(EntityManagerInterface $em,int $id): Response
    {
        $video = $em->getRepository(Videos::class)->find($id);
        $em->remove($video);
        $em->flush();

        $this->addFlash('success', 'Product deleted');

        return $this->redirectToRoute('home_page');
    }

}
