<?php

declare(strict_types=1);
namespace App\Controller;

use App\Service\ImageService;
use App\Service\UserService;
use App\Service\PasswordHasher;
use App\View\PhpTemplateEngine;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class UserController extends AbstractController
{
    private Environment $twig;
    private ImageService $imageService;
    private UserService $userService;
    private PasswordHasher $passwordHasher;

    public function __construct(UserService $userService, ImageService $imageService, PasswordHasher $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
        $this->imageService = $imageService;
        $this->userService = $userService;
        $this->twig = new Environment(new FilesystemLoader("../templates"));
    }

    public function index(): Response
    {
        $contents = $this->twig->render("register.html.twig");
        return new Response($contents);
    }

    public function showLogin(): Response
    {
        $contents = $this->twig->render("login.html.twig");
        return new Response($contents);
    }

    public function loginUser(Request $request): Response
    {
        $userEmail = $request->get("email");
        $userPassword = $request->get("password");
        $user = $this->userService->getUserByEmail($userEmail);

        if ($user === null)
        {
            return $this->redirectToRoute("show_login", [], Response::HTTP_SEE_OTHER);
        }

        if (!$this->passwordHasher->verify($user->getPassword(), $userPassword))
        {
            return $this->redirectToRoute("show_login", [], Response::HTTP_SEE_OTHER);
        }
        session_start();
        $_SESSION["email"] = $userEmail;
        return $this->redirectToRoute(
            "show_katalog",
            ["userId" => $user->getUserId()],
            Response::HTTP_SEE_OTHER
        );
    }

    public function registerUser(Request $request): Response
    {
        $illustrationPath = null;
        if ($_FILES["avatar_path"] !== null && $_FILES["avatar_path"]["name"] !== "")
        {
            $illustrationPath = $this->imageService->moveImageToUploads($_FILES["avatar_path"]);
        }

        if (!$this->validForm($request))
        {
            $contents = PhpTemplateEngine::render("register.html.twig");
            return new Response($contents);
        }
    
        $userId = $this->userService->saveUser($request, $illustrationPath);
        
        $_SESSION["email"] = $request->get("email");
        return $this->redirectToRoute(
            "show_katalog",
            ["userId" => $userId],
            Response::HTTP_SEE_OTHER
        );
    }

    private function validForm(Request $request): bool
    {
        if ($request->get("email") !== null)
        {
            $email = $request->get("email");
            $email_validation_regex = "/^\\S+@\\S+\\.\\S+$/"; 
            if (!(preg_match($email_validation_regex, $email))) 
            {
                return false;
            }
        }
        if ($request->get("phone") !== null)
        {
            $phone = $request->get("phone");
            if (!is_numeric($phone)) 
            {
                return false;
            }            
        }

        return true;
    }

}