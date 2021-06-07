<?php

namespace App\Controller;

use App\Repository\PostsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     * @Route("/", name="default")
     * @Route("/search/{searchterm}", name="search", defaults={"searchterm":""})
     */
    public function index(PostsRepository $postRepo, $searchterm = ""): Response
    {
        $posts = [];
        if (!empty($searchterm)) {
            $posts = $postRepo->customSearch($searchterm);
        } else {
            $posts = $postRepo->findAll();
        }
        return $this->render('home/index.html.twig', [
            "posts" => $posts
        ]);
    }
}
