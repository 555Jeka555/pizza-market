<?php

declare(strict_types=1);
namespace App\Service;

use App\Repository\PizzaRepository;
use App\Service\Data\PizzaData;
use Symfony\Component\HttpFoundation\Request;

class PizzaService implements PizzaServiceInterface 
{

    private PizzaRepository $pizzaRepository;

    public function __construct(PizzaRepository $pizzaRepository)
    {
        $this->pizzaRepository = $pizzaRepository;
    }

    public function savePizza(Request $request, string $illustrationPath): int
    {
        return 0;
    }
   
    public function getPizza(int $pizzaId): ?PizzaData
    {
        $pizza = $this->pizzaRepository->findById($pizzaId);
        if ($pizza === null) 
        {
            return null;
        }
        return new PizzaData (
            $pizza->getPizzaId(),
            $pizza->getTitle(),
            $pizza->getSubTitle(),
            $pizza->getPrice(),
            $pizza->getLastPrice(),
            $pizza->getPizzaImgPath(),
        );
    }

    public function deletePizza(int $userId): void
    {}

    public function listPizzas(): array
    {
        return $this->pizzaRepository->listAll();
    }
}