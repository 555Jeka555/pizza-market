<?php

declare(strict_types=1);
namespace App\Controller;

use App\Service\PizzaService;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class StorefrontController extends AbstractController
{
    private Environment $twig;
    private UserService $userService;
    private PizzaService $pizzaService;

    public function __construct(PizzaService $pizzaService, UserService $userService)
    {
        $this->userService = $userService;
        $this->pizzaService = $pizzaService;
        $this->twig = new Environment(new FilesystemLoader("../templates"));
    }

    public function index(int $userId): Response
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            return $this->redirectToRoute("show_login");
        }
        
        $user = $this->userService->getUser($userId);
        if (!$user) 
        {
            throw $this->createNotFoundException();
        }
        $pizzas = $this->pizzaService->listPizzas();

        $contents = $this->twig->render("katalog.html.twig", [
            "title" => "Pizza-market",
            "user" => $user,
            "pizzas" => $pizzas
        ]);

        return new Response($contents);
    }
}