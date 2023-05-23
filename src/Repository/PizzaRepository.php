<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Pizza;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class PizzaRepository
{
    private EntityManagerInterface $entityManeger;
    private EntityRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManeger = $entityManager;
        $this->repository = $entityManager->getRepository(Pizza::class);
    }

    public function findById(int $id): ?Pizza
    {
        $pizza = $this->repository->findOneBy(["pizzaId" => (string) $id]);
        if ($pizza !== null) 
        {
            return new Pizza(
                $pizza->getPizzaId(),
                $pizza->getTitle(),
                $pizza->getSubTitle(),
                $pizza->getPrice(),
                $pizza->getLastPrice(),
                $pizza->getPizzaImgPath()
            );
        }
    }

    public function store(Pizza $pizza): int
    {
        $this->entityManeger->persist($pizza);
        $this->entityManeger->flush();
        return $pizza->getPizzaId();
    }

    public function delete(Pizza $pizza): void
    {
        $this->entityManeger->remove($pizza);
        $this->entityManeger->flush();
    }

    public function listAll(): array
    {
        return $this->repository->findAll();
    }

}