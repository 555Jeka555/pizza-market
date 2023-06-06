<?php

declare(strict_types=1);
namespace App\Controller;
use App\Service\ImageService;
use App\Service\OrderService;
use App\Service\PizzaService;
use App\Service\UserService;
use App\Service\Data\UserData;
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
    private OrderService $orderService;

    public function __construct(ImageService $imageService, PizzaService $pizzaService, UserService $userService, OrderService $orderService)
    {
        $this->userService = $userService;
        $this->pizzaService = $pizzaService;
        $this->imageService = $imageService;
        $this->orderService = $orderService;
        $this->twig = new Environment(new FilesystemLoader("../templates"));
    }

    public function index(int $pizzaId): Response
    {
        session_start();
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
        $_SESSION["pizzaId"] = $pizzaId;

        $contents = $this->twig->render("order.html.twig", [
            "title" => "Order",
            "user" => $user,
            "pizza" => $pizza
        ]);
        return new Response($contents);
    }

    public function makeOrder(Request $request): Response
    {
        session_start();
        $user = $this->userService->getUserByEmail($_SESSION["email"]);
        if (!$user) 
        {
            throw $this->createNotFoundException();
        }

        $pizza = $this->pizzaService->getPizza($_SESSION["pizzaId"]);
        if (!$pizza) 
        {
            throw $this->createNotFoundException();
        }

        if (!$this->validform($request))
        {
            $contents = $this->twig->render("order.html.twig", [
                "title" => "Order",
                "user" => $user,
                "pizza" => $pizza
            ]);
            return new Response($contents);
        }

        $orderId = $this->orderService->saveOrder($user, $pizza, $request);

        $contents = $this->twig->render("feedback.html.twig", [
            "title" => "FeedBack",
            "user" => $user,
            "orderId" => $orderId,
        ]);
        return new Response($contents);
    }

    public function validForm(Request $request): bool
    {
        if (!is_numeric($request->get("number_card")) || !is_numeric($request->get("number_back_card"))  || !is_numeric($request->get("date_card")))
        {
            return false;
        }

        if (!((int)$request->get("number_card") == 16) || !((int)$request->get("number_back_card") == 3)  || !((int)$request->get("date_card") == 4))
        {
            return false;
        }

        return true;
    }

}