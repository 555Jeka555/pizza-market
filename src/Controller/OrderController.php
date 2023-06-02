<?php

declare(strict_types=1);
namespace App\Controller;
use App\Service\ImageService;
use App\Service\PizzaService;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class OrderController extends AbstractController
{
    private Environment $twig;
    private ImageService $imageService;
    private UserService $userService;
    private PizzaService $pizzaService;

    public function __construct(ImageService $imageService, PizzaService $pizzaService, UserService $userService)
    {
        $this->userService = $userService;
        $this->pizzaService = $pizzaService;
        $this->imageService = $imageService;
        $this->twig = new Environment(new FilesystemLoader("../templates"));
    }

    public function index(int $pizzaId): Response
    {
        $user = $this->userService->getUserByEmail($_SESSION["email"]);
        if (!$user) 
        {
            throw $this->createNotFoundException();
        }

        $pizza = $this->pizzaService->getPizza($pizzaId);
        if (!$pizza) 
        {
            throw $this->createNotFoundException();
        }

        $contents = $this->twig->render("order.html.twig", [
            "title" => "Order",
            "user" => $user,
            "pizza" => $pizza
        ]);
        return new Response($contents);
    }

    public function makeOrder(Request $request): Response
    {
        $jsonString = $request->getContent();
        $data = json_decode($jsonString, true);

        $user = $this->userService->getUserByEmail($_SESSION["email"]);
        if (!$user) 
        {
            throw $this->createNotFoundException();
        }
        

        $contents = $this->twig->render("feedback.html.twig", [
            "title" => "FeedBack",
            "user" => $user
        ]);
        return new Response($contents);
    }

}