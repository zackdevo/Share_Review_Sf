<?php

namespace App\Controller;

use App\Entity\Posts;
use App\Form\CreateFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContentController extends AbstractController
{
    /**
     * @Route("/create", name="create")
     */
    public function index(): Response
    {
        return $this->render('new/create.html.twig', [
            'controller_name' => 'ContentController',
        ]);
    }
    /**
     * @Route("/new", name="new")
     */
    public function create(Request $request): Response
    {
        $posts = new Posts();
        $form = $this->createForm(CreateFormType::class, $posts);
        $form->handleRequest($request);
        $user = $this->getUser();

        if ($form->isSubmitted() && $form->isValid()) {

            $title = $request->request->get("title");
            $subtitle = $request->request->get("subtitle");
            $content = $request->request->get("content");
            $newPost = new Posts();
            $newPost->setCreatedAt(new \DateTime());
            $newPost->setAuthor($user);
            $newPost->setTitle($title);
            $newPost->setSubtitle($subtitle);
            $newPost->setContent($content);
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($newPost);
            $manager->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('new/create.html.twig',  [
            'createForm' => $form->createView(),
        ]);
    }
}
