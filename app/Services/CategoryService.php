<?php

namespace App\Services;

use App\Repositories\CategoryRepositoryInterface;

class CategoryService
{
    private $repository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(): object
    {
        return $this->repository->getAll();
    }

    public function create(array $data): object
    {
        $category = $this->repository->create($data);

        return $category;
    }

    public function show(string $slug): object
    {
        $category = $this->repository->show($slug);

        return $category;
    }

    public function update(string $slug, array $data): bool
    {
        $response = $this->repository->update($slug, $data);

        return $response;
    }

    public function delete(string $slug): bool
    {
        $response = $this->repository->delete($slug);

        return $response;
    }
}
