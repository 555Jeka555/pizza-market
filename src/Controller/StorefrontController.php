<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Model\Upload;
use App\Repository\PizzaRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class StorefrontController extends AbstractController
{
    private PizzaRepository $pizzaRepository;
    private UserRepository $userRepository;
    private Upload $upload;
    private Environment $twig;

    public function __construct(PizzaRepository $pizzaRepository, UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->pizzaRepository = $pizzaRepository;
        $this->upload = new Upload();
        $this->twig = new Environment(new FilesystemLoader("../templates"));
    }

    public function index(int $userId): Response
    {

        $user = $this->userRepository->findById($userId);
        if (!$user) {
            throw $this->createNotFoundException();
        }

        $pizzas = $this->pizzaRepository->listAll();

        $contents = $this->twig->render("katalog.html.twig", [
            "title" => "Pizza-market",
            "user" => $user,
            "pizzas" => $pizzas
        ]);

        return new Response($contents);
    }

}