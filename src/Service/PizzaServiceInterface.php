<?php

declare(strict_types=1);
namespace App\Service;

use App\Service\Data\PizzaData;
use Symfony\Component\HttpFoundation\Request;

interface PizzaServiceInterface
{
    public function savePizza(Request $request, string $illustrationPath): int;
   
    public function getPizza(int $userId): ?PizzaData;

    public function deletePizza(int $userId): void;

    public function listPizzas(): array;
}
