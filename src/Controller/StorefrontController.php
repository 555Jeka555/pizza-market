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
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class StorefrontController extends AbstractController
{
    private UserTable $userTable;
    private Upload $upload;
    private Environment $twig;

    public function __construct()
    {
        $connection = ConnectionProvider::connectDatabase();
        $this->userTable = new UserTable($connection);
        $this->upload = new Upload();
        $this->twig = new Environment(new FilesystemLoader("../templates"));
    }

    public function index(User $user): Response
    {
        $pizzas = $this->userTable->getAllPizzas();

        $contents = $this->twig->render("katalog.html.twig", [
            "title" => "Pizza-market",
            "user" => $user,
            "pizzas" => $pizzas
        ]);

        return new Response($contents);
    }

}