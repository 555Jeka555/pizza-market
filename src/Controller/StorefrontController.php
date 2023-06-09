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

class StorefrontController extends AbstractController
{
    private Environment $twig;
    private UserService $userService;
    private ImageService $imageService;
    private PizzaService $pizzaService;

    public function __construct(PizzaService $pizzaService, ImageService $imageService, UserService $userService)
    {
        $this->userService = $userService;
        $this->imageService = $imageService;
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

    public function addPizza(Request $request): Response
    {
        session_start();
        $userId = $this->userService->getUserByEmail($_SESSION['email'])->getUserId();
        $imagePath = null;
        if ($_FILES["pizza_image"] !== null && $_FILES["pizza_image"]["name"] !== "")
        {
            $imagePath = $this->imageService->moveImageToUploads($_FILES["pizza_image"], "images");
        }
        else
        {
            return $this->redirectToRoute(
                "show_katalog",
                ["userId" => $userId],
                Response::HTTP_SEE_OTHER
            );
        }

        if (!$this->validform($request))
        {
            return $this->redirectToRoute(
                "show_katalog",
                ["userId" => $userId],
                Response::HTTP_SEE_OTHER
            );
        }

        $this->pizzaService->savePizza($request, $imagePath);

        return $this->redirectToRoute(
            "show_katalog",
            ["userId" => $userId],
            Response::HTTP_SEE_OTHER
        );
    }

    public function delPizza(Request $request): Response
    {
        session_start();
        $userId = $this->userService->getUserByEmail($_SESSION['email'])->getUserId();
        $this->pizzaService->deletePizza((int)$request->get("pizza_id"));

        return $this->redirectToRoute(
            "show_katalog",
            ["userId" => $userId],
            Response::HTTP_SEE_OTHER
        );
    }

    public function validForm(Request $request): bool
    {
        if (!is_numeric($request->get("price")) || !is_numeric($request->get("last_price")))
        {
            return false;
        }
        return true;
    }
}