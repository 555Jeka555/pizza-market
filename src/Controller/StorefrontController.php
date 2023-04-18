<?php

declare(strict_types=1);

namespace App\Controller;

use App\Database\UserTable;
use App\Database\ConnectionProvider;
use App\Model\User;
use App\Model\Pizza;
use App\Model\Upload;
use App\View\PhpTemplateEngine;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class StorefrontController extends AbstractController
{
    private UserTable $userTable;
    private Upload $upload;

    public function __construct()
    {
        $connection = ConnectionProvider::connectDatabase();
        $this->userTable = new UserTable($connection);
        $this->upload = new Upload();
    }

    public function index(User $user): Response
    {
        $pizzas = $this->userTable->getAllPizzas();

        $contents = PhpTemplateEngine::render("katalog.php", [
            "user" => $user,
            "pizzas" => $pizzas
        ]);

        return new Response($contents);
    }

}