<?php

declare(strict_types=1);
namespace App\Service;

use App\Service\Data\PizzaData;
use Symfony\Component\HttpFoundation\Request;

interface PizzaServiceInterface
{
    public function savePizza(Request $request, string $illustrationPath): int;
   
    public function getPizza(int $pizzaId): ?PizzaData;

    public function deletePizza(int $pizzaId): void;

    public function listPizzas(): array;
}
