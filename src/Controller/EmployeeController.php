<?php
// src/Controller/EmployeeController.php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Videos;
use App\Form\VideosType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class EmployeeController extends AbstractController
{
#[Route('/employee', name: 'app_employee')]
public function index(): Response
{
return $this->render('employee/index.html.twig', [
'controller_name' => 'EmployeeController',
]);
}

#[Route("/addvideo/{categoryId}", name: "add_video")]
#[IsGranted('ROLE_USER')]
public function addVideo(Request $request, EntityManagerInterface $em, int $categoryId): Response
{
$video = new Videos();
$category = $em->getRepository(Categories::class)->find($categoryId);
if (!$category) {
throw $this->createNotFoundException('No category found for id ' . $categoryId);
}

$video->addCategory($category);

$form = $this->createForm(VideosType::class, $video);
$form->handleRequest($request);

if ($form->isSubmitted() && $form->isValid()) {
$em->persist($video);
$em->flush();
$this->addFlash('success', 'Video added successfully');

return $this->redirectToRoute('category_page', ['id' => $categoryId]);
}

return $this->render('employee/addvideo.html.twig', [
'form' => $form->createView(),
'categoryId' => $categoryId,
]);
}

#[Route('/showVideo/{categoryId}', name: 'show_video')]
#[IsGranted('ROLE_USER')]
public function showVideo(EntityManagerInterface $em, int $categoryId): Response
{
$category = $em->getRepository(Categories::class)->find($categoryId);
$videos = $category ? $category->getVideos() : [];

return $this->render('employee/showVideo.html.twig', [
'videos' => $videos,
'categoryId' => $categoryId,
]);
}

#[Route('/editVideo/{id}/{categoryId}', name: 'edit_video')]
#[IsGranted('ROLE_USER')]
public function editVideo(int $id, int $categoryId, Request $request, EntityManagerInterface $em): Response
{
$video = $em->getRepository(Videos::class)->find($id);
if (!$video) {
throw $this->createNotFoundException('Video not found');
}

$form = $this->createForm(VideosType::class, $video);
$form->handleRequest($request);

if ($form->isSubmitted() && $form->isValid()) {
$em->flush();
$this->addFlash('success', 'Video updated successfully');

return $this->redirectToRoute('category_page', ['id' => $categoryId]);
}

return $this->render('employee/editVideo.html.twig', [
'form' => $form->createView(),
'categoryId' => $categoryId,
]);
}

#[Route('/videos/delete/{id}/{categoryId}', name: 'delete_video')]
#[IsGranted('ROLE_ADMIN')]
public function deleteVideo(EntityManagerInterface $em, int $id, int $categoryId): Response
{
$video = $em->getRepository(Videos::class)->find($id);
if (!$video) {
throw $this->createNotFoundException('Video not found');
}

$em->remove($video);
$em->flush();

$this->addFlash('success', 'Video deleted successfully');

return $this->redirectToRoute('category_page', ['id' => $categoryId]);
}
}
