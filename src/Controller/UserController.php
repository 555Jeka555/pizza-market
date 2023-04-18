<?php

declare(strict_types=1);

namespace App\Controller;

use App\Database\ConnectionProvider;
use App\Database\UserTable;
use App\Model\User;
use App\Model\Upload;
use App\View\PhpTemplateEngine;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    // private const HTTP_STATUS_303_SEE_OTHER = 303;
    private UserTable $userTable;
    private Upload $upload;

    public function __construct()
    {
        $connection = ConnectionProvider::connectDatabase();
        $this->userTable = new UserTable($connection);
        $this->upload = new Upload();
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
            $request->get("email"), (int)$request->get("phone"), $illustrationPath
        );

        $userId = $this->userTable->saveUser($user);
        
        return $this->redirectToRoute(
            "show_katalog",
            ["userId" => $userId],
            Response::HTTP_SEE_OTHER
        );
    }

    public function viewKatalog(int $userId): Response
    {
        $user = $this->userTable->findUser($userId);
        if (!$user) {
            throw $this->createNotFoundException();
        }

        $storefrontController = new StorefrontController();
        
        // $contents = PhpTemplateEngine::render("katalog.php", [
        //     "user" => $user
        // ]);
        // return new Response($contents);
        return $storefrontController->index($user);
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