<?php
// src/Controller/AdminController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Categories;
use App\Entity\User;
use App\Entity\Videos;
use App\Form\CategoriesType;
use App\Form\UserType;
use App\Form\VideosType;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin_dashboard')]
    #[IsGranted('ROLE_ADMIN')]
    public function adminDashboard(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    #[Route('/admin/users', name: 'admin_users')]
    #[IsGranted('ROLE_ADMIN')]
    public function manageUsers(EntityManagerInterface $em): Response
    {
        $users = $em->getRepository(User::class)->findAll();

        return $this->render('admin/users/index.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('/admin/user/add', name: 'admin_user_add')]
    #[IsGranted('ROLE_ADMIN')]
    public function addUser(Request $request, EntityManagerInterface $em): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'User added successfully');
            return $this->redirectToRoute('admin_users');
        }

        return $this->render('admin/users/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/user/edit/{id}', name: 'admin_user_edit')]
    #[IsGranted('ROLE_ADMIN')]
    public function editUser(int $id, Request $request, EntityManagerInterface $em): Response
    {
        $user = $em->getRepository(User::class)->find($id);
        if (!$user) {
            throw $this->createNotFoundException('No user found for id ' . $id);
        }

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            $this->addFlash('success', 'User updated successfully');
            return $this->redirectToRoute('admin_users');
        }

        return $this->render('admin/users/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/user/delete/{id}', name: 'admin_user_delete')]
    #[IsGranted('ROLE_ADMIN')]
    public function deleteUser(int $id, EntityManagerInterface $em): Response
    {
        $user = $em->getRepository(User::class)->find($id);
        if (!$user) {
            throw $this->createNotFoundException('No user found for id ' . $id);
        }

        $em->remove($user);
        $em->flush();

        $this->addFlash('success', 'User deleted successfully');
        return $this->redirectToRoute('admin_users');
    }

    #[Route('/admin/categories', name: 'admin_categories')]
    #[IsGranted('ROLE_ADMIN')]
    public function manageCategories(EntityManagerInterface $em): Response
    {
        $categories = $em->getRepository(Categories::class)->findAll();

        return $this->render('admin/categories/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/admin/category/add', name: 'admin_category_add')]
    #[IsGranted('ROLE_ADMIN')]
    public function addCategory(Request $request, EntityManagerInterface $em): Response
    {
        $category = new Categories();
        $form = $this->createForm(CategoriesType::class, $category);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($category);
            $em->flush();

            $this->addFlash('success', 'Category added successfully');
            return $this->redirectToRoute('admin_categories');
        }

        return $this->render('admin/categories/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/category/edit/{id}', name: 'admin_category_edit')]
    #[IsGranted('ROLE_ADMIN')]
    public function editCategory(int $id, Request $request, EntityManagerInterface $em): Response
    {
        $category = $em->getRepository(Categories::class)->find($id);
        if (!$category) {
            throw $this->createNotFoundException('No category found for id ' . $id);
        }

        $form = $this->createForm(CategoriesType::class, $category);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            $this->addFlash('success', 'Category updated successfully');
            return $this->redirectToRoute('admin_categories');
        }

        return $this->render('admin/categories/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/category/delete/{id}', name: 'admin_category_delete')]
    #[IsGranted('ROLE_ADMIN')]
    public function deleteCategory(int $id, EntityManagerInterface $em): Response
    {
        $category = $em->getRepository(Categories::class)->find($id);
        if (!$category) {
            throw $this->createNotFoundException('No category found for id ' . $id);
        }

        $em->remove($category);
        $em->flush();

        $this->addFlash('success', 'Category deleted successfully');
        return $this->redirectToRoute('admin_categories');
    }

    #[Route('/admin/videos', name: 'admin_videos')]
    #[IsGranted('ROLE_ADMIN')]
    public function manageVideos(EntityManagerInterface $em): Response
    {
        $videos = $em->getRepository(Videos::class)->findAll();

        return $this->render('admin/videos/index.html.twig', [
            'videos' => $videos,
        ]);
    }

    #[Route('/admin/video/add', name: 'admin_video_add')]
    #[IsGranted('ROLE_ADMIN')]
    public function addVideo(Request $request, EntityManagerInterface $em): Response
    {
        $video = new Videos();
        $form = $this->createForm(VideosType::class, $video);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($video);
            $em->flush();

            $this->addFlash('success', 'Video added successfully');
            return $this->redirectToRoute('admin_videos');
        }

        return $this->render('admin/videos/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/video/edit/{id}', name: 'admin_video_edit')]
    #[IsGranted('ROLE_ADMIN')]
    public function editVideo(int $id, Request $request, EntityManagerInterface $em): Response
    {
        $video = $em->getRepository(Videos::class)->find($id);
        if (!$video) {
            throw $this->createNotFoundException('No video found for id ' . $id);
        }

        $form = $this->createForm(VideosType::class, $video);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            $this->addFlash('success', 'Video updated successfully');
            return $this->redirectToRoute('admin_videos');
        }

        return $this->render('admin/videos/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/video/delete/{id}', name: 'admin_video_delete')]
    #[IsGranted('ROLE_ADMIN')]
    public function deleteVideo(int $id, EntityManagerInterface $em): Response
    {
        $video = $em->getRepository(Videos::class)->find($id);
        if (!$video) {
            throw $this->createNotFoundException('No video found for id ' . $id);
        }

        $em->remove($video);
        $em->flush();

        $this->addFlash('success', 'Video deleted successfully');
        return $this->redirectToRoute('admin_videos');
    }
}

