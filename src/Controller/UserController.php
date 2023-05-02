<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Model\Upload;
use App\Repository\UserRepository;
use App\View\PhpTemplateEngine;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    private Upload $upload;
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->upload = new Upload();
        $this->userRepository = $userRepository;
    }

    public function index(): Response
    {
        $contents = PhpTemplateEngine::render("register.php");
        return new Response($contents);
    }

    public function registerUser(Request $request): Response
    {
        $illustrationPath = null;
        if ($_FILES["avatar_path"] !== null)
        {
            $illustrationPath = $this->upload->moveImageToUploads($_FILES["avatar_path"]);
        }

        if (!$this->validForm($request))
        {
            $contents = PhpTemplateEngine::render("register.php");
            return new Response($contents);
        }
        
        $user = new User(
            null, $request->get("first_name"), $request->get("second_name"),
            $request->get("email"), $request->get("phone"), $illustrationPath
        );

        $userId = $this->userRepository->store($user);
        
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